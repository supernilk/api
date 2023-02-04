<?php

    class Usuario {
        private $ID_usuario;
        private $nombre;
        private $correo;
        private $password;
        private $token;
        
        public $nu_tipo_entidad_prf;
        public $in_clasificacion_tipo_ent_prf;
        public $dni_enterprise;
        public $nu_tipo_entidad_doc_ent;
        public $in_clasificacion_tipo_ent_doc_ent;


        //-------------------------------------------

        private $DB_HOST       = "localhost";
        private $DB_USUARIO    = "ventaso2_admin_sisregin";
        private $DB_CONTRA     = "admin*sisregin";
        private $DB_NOMBRE     = "ventaso2_sisregin";
        
        //private $DB_HOST       = "localhost";
        //private $DB_USUARIO    = "root";
        //private $DB_CONTRA     = "";
        //private $DB_NOMBRE     = "ventaso2_sisregin";

        protected $conexion;


        // consultar esta direccion    
        // http://www.franaramayo.com/consultas-php-mysql-orientadas-a-objetos/
        public function __construct(){
            // nada por ahora ...
            // echo "ingresando a usuario_class";
        }

        // Generamos el Token
        // http://w3.unpocodetodo.info/jsblog/es6-fetch-await.php
        function crearToken(int $length = 64){ // 64 = 32
            $length = ($length < 4) ? 4 : $length;
            return bin2hex(random_bytes(($length-($length%2))/2));  
        }

        // metodo que conecta con la Base de Datos
        public function abrirConexion() {

            $this->conexion = new mysqli($this->DB_HOST,$this->DB_USUARIO,$this->DB_CONTRA,$this->DB_NOMBRE);

            if ($this->conexion->connect_errno){
                echo "Fallo al conectar a MySql: " . $this->conexion->connect_errno;
            }

            $this->conexion->set_charset("utf8");

        }

        // metodo que cierra la conexcion a la Base de Datos
        public function cerrarConexion(){
            $this->conexion->close();
        }

        //INSERTAR en la BD
        public function insertar($tabla,$datos){
            //echo ("tabla: $tabla  datos: $datos \n");
            //echo ("INSERT INTO $tabla VALUES ($datos)");
            $resultado = $this->conexion->query("INSERT INTO $tabla VALUES ($datos)") or die($this->conexion->error);
            return $resultado ? true : false;
        }

        //BORRAR en la BD
        public function borrar($tabla,$condicion){
            $resultado = $this->conexion->query("INSERT INTO $tabla VALUES (null,$condicion)") or die($this->conexion->error);
            return $resultado ? true : false;
        }

        //BORRAR token en la BD
        public function borrarToken(){
            $resultado = $this->conexion->query("DELETE FROM token WHERE ID_Usuario = $this->ID_usuario") or die($this->conexion->error);
            return $resultado ? true : false;
        }

        //BORRAR token en la BD
        public function guardarToken(){
            
            $tiempo = time()+(60*60*24*7);
            
            $sql="INSERT INTO token VALUES (null, $this->ID_usuario, '$this->token','$tiempo')";
            
            //echo ($sql);
            
            //$resultado=1;
            
            $resultado = $this->conexion->query($sql) or die($this->conexion->error);

            return $resultado ? true : false;
        }

        public function consultarToken($token_a_comparar)
        {
            $this->abrirConexion();
            
            $sql="SELECT COUNT(t.ID_Usuario) as n_filas, 
			                u.username, 
                            u.ID_Usuario,
                            u.nu_tipo_entidad_prf, 
                            u.in_clasificacion_tipo_ent_prf 
                        FROM token t JOIN usuario u ON t.ID_Usuario=u.ID_Usuario 
                        WHERE t.token ='$token_a_comparar'";
                        
            //print_r($sql."\n");
            
            $resultado = $this->conexion->query($sql) or die($this->conexion->error);

            $resultado = $resultado->fetch_all(MYSQLI_ASSOC);
            
            // muestar la cantidad de filas encontradas
            $n_filas=$resultado[0]["n_filas"];

            $this->cerrarConexion();
            
            if ($n_filas==1){
                //echo "token valido\n";
                $this->ID_usuario=intval($resultado[0]["ID_Usuario"]);
                $this->nombre=$resultado[0]["username"];
                $this->nu_tipo_entidad_prf = $resultado[0]["nu_tipo_entidad_prf"];
                $this->in_clasificacion_tipo_ent_prf = $resultado[0]["in_clasificacion_tipo_ent_prf"];

            }else{
                //echo "token no valido\n";
            }

            return ($n_filas==1) ? true : false;
        }


        //ACTUALIZAR en la BD
        public function actualizar($tabla,$campos,$condicion){
            $resultado = $this->conexion->query("UPDATE $tabla SET $campos where $condicion") or die($this->conexion->error);
            return $resultado ? true : false;
        }

        //BUSCAR en la BD
        public function buscar($tabla, $condicion){
            $resultado = $this->conexion->query("SELECT * FROM $tabla where $condicion") or die($this->conexion->error);
            return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : false;
        }

        public function get_Nombre(){
            return $this->nombre;
        }

        public function get_Correo(){
            return $this->correo;
        }

        public function get_Password(){
            return $this->password;
        }

        public function get_Token(){
            return $this->token;
        }

        public function ID_usuario($ID){
            $this->ID_usuario = $ID;
        }
        
        public function set_Nombre($nombre){
            $this->nombre = $nombre;
        }

        public function set_Correo($correo){
            $this->correo = $correo;
        }

        public function set_Password($password){
            $this->password = $password;
        }

        public function consultarUsuario() // <-- inicio de sesion
        {       
            // abrimos la coneccion para hacer la consulta a la bd
            $this->abrirConexion();
            // me crea una array asosiativo de los elemento a consultar
            // https://www.tutorialspoint.com/php/php_function_mysqli_fetch_all.htm
            $rows = $this->buscar("usuario","emailuser = '".$this->correo."' and ".
                                    "password = '".$this->password."'");
            
            //print_r($rows);
/*
            print_r($rows[0]["ID_Usurio"]);
            print_r($rows[0]["username"]);
            */

            // count me indica si el array tiene elemento
            // es decir si encontro o no encontro el usuario con su clave
            $resultado = count($rows);
            
            if ($resultado > 0){
                $this->ID_usuario=intval($rows[0]["ID_Usuario"]);
                $this->nombre=$rows[0]["username"];
                $this->token=$this->crearToken();
                $this->nu_tipo_entidad_prf = $rows[0]["nu_tipo_entidad_prf"];
                $this->in_clasificacion_tipo_ent_prf = $rows[0]["in_clasificacion_tipo_ent_prf"];
                
                $this->dni_enterprise = $rows[0]["dni_enterprise"];
                $this->nu_tipo_entidad_doc_ent = $rows[0]["nu_tipo_entidad_doc_ent"];
                $this->in_clasificacion_tipo_ent_doc_ent= $rows[0]["in_clasificacion_tipo_ent_doc_ent"];


                $this->borrarToken();
                $this->guardarToken();

            }

            // toda coneccion debe cerrarce una vez finalizada la consulta
            $this->cerrarConexion();
            return $resultado > 0 ? true : false ;
        }
        
        public function actualizarUsuario($campo_modif,$campo_nuevo_valor)
        {
            # code...
            # sql: SELECT * FROM token t JOIN usuario u ON t.ID_Usuario=u.ID_Usurio WHERE	t.token ="73b82ece748866749d66411d908585ae4192b967"
        }

/*******************************************************************************************************************************************/
        // Buscamos todos los usuarios segun la empresa.
        public function consultar_todos_Usuarios($dni_enterprise, $nu_tipo_entidad_doc_ent,$in_clasificacion_tipo_ent_doc_ent){
            
            $this->abrirConexion();
            
            $sql="select CONCAT(Nombre, ' ', Apellido) As Nombre,u.emailuser as email,u.username,t.descripcion perfil   
                    from usuario u, persona p,tipo_entidad t
                    where u.dni = p.dni AND 
                    u.nu_tipo_entidad_doc = p.nu_tipo_entidad_doc AND
                    u.in_clasificacion_tipo_ent_doc = p.in_clasificacion_tipo_ent_doc AND
                    u.emailuser = p.email AND
                    u.nu_tipo_entidad_prf = t.nu_tipo_entidad AND
                    u.in_clasificacion_tipo_ent_prf = t.in_clasificacion_tipo_ent AND
                    u.dni_enterprise = '$dni_enterprise' AND
                    u.nu_tipo_entidad_doc_ent = $nu_tipo_entidad_doc_ent AND
                    u.in_clasificacion_tipo_ent_doc_ent = '$in_clasificacion_tipo_ent_doc_ent'";

            $resultado = $this->conexion->query($sql) or die($this->conexion->error);

            $resultado = $resultado->fetch_all(MYSQLI_ASSOC);

            // toda coneccion debe cerrarce una vez finalizada la consulta
            $this->cerrarConexion();
            return $resultado;
            
        }
        
/*******************************************************************************************************************************************/
        // Buscamos todos los usuarios segun parametros de busqueda (buscar) y los datos de la empresa.
        public function consulta_Usuario($dni_enterprise, $nu_tipo_entidad_doc_ent,$in_clasificacion_tipo_ent_doc_ent, $buscar){
            
            $this->abrirConexion();
            
            $sql="select CONCAT(Nombre, ' ', Apellido) As Nombre,u.emailuser as email,u.username,t.descripcion perfil   
                    from usuario u, persona p,tipo_entidad t
                    where u.dni = p.dni AND 
                    u.nu_tipo_entidad_doc = p.nu_tipo_entidad_doc AND
                    u.in_clasificacion_tipo_ent_doc = p.in_clasificacion_tipo_ent_doc AND
                    u.emailuser = p.email AND
                    u.nu_tipo_entidad_prf = t.nu_tipo_entidad AND
                    u.in_clasificacion_tipo_ent_prf = t.in_clasificacion_tipo_ent AND
                    u.dni_enterprise = '$dni_enterprise' AND
                    u.nu_tipo_entidad_doc_ent = $nu_tipo_entidad_doc_ent AND
                    u.in_clasificacion_tipo_ent_doc_ent = '$in_clasificacion_tipo_ent_doc_ent' AND
                    CONCAT(Nombre, ' ', Apellido) like '%$buscar%'";


            $resultado = $this->conexion->query($sql) or die($this->conexion->error);

            $resultado = $resultado->fetch_all(MYSQLI_ASSOC);

            // toda coneccion debe cerrarce una vez finalizada la consulta
            $this->cerrarConexion();
            return $resultado;
            
        }

/*******************************************************************************************************************************************/
        public function consultarEntidades()
        {       

            $sql="SELECT nu_entidad, in_clasificacion_ent, nu_tipo_entidad, in_clasificacion_tipo_ent, descripcion FROM tipo_entidad WHERE 
                         in_clasificacion_ent in ('CNT','ALM','LOC') and
                         nu_tipo_entidad > 0 AND 
                         dni_enterprise='$this->dni_enterprise' AND
                         nu_tipo_entidad_doc_ent= $this->nu_tipo_entidad_doc_ent AND
                         in_clasificacion_tipo_ent_doc_ent = '$this->in_clasificacion_tipo_ent_doc_ent' AND
                         nu_tipo_entidad_sta=1 AND 
                         in_clasificacion_tipo_ent_sta='ACT'";

            $resultado = $this->conexion->query($sql) or die($this->conexion->error);

            $resultado = $resultado->fetch_all(MYSQLI_ASSOC);

            // toda coneccion debe cerrarce una vez finalizada la consulta
            $this->cerrarConexion();
            return $resultado;
        }  
/*******************************************************************************************************************************************/
        public function consultar_roles()
        {       
            //echo ("nu_tipo_entidad_prf: /".$this->nu_tipo_entidad_prf."/ " );
            //echo ("in_clasificacion_tipo_ent_prf: /".$this->in_clasificacion_tipo_ent_prf."/" );
            
            $this->abrirConexion();
            if ($this->nu_tipo_entidad_prf <=2){
                //"Tienes permisos"
                $sql="SELECT nu_tipo_entidad AS nu_tipo_entidad_prf,
                             in_clasificacion_tipo_ent as in_clasificacion_tipo_ent_prf,
                             descripcion  
                            FROM tipo_entidad 
                            WHERE in_clasificacion_ent='PRF'";
            }else{
                //"eres lvl 3 no tiens permisos"
                $sql="SELECT nu_tipo_entidad AS nu_tipo_entidad_prf, 
                             in_clasificacion_tipo_ent as in_clasificacion_tipo_ent_prf,
                             descripcion  
                            FROM tipo_entidad 
                            WHERE in_clasificacion_ent='PRF' AND
                             `nu_tipo_entidad`=3 AND
                             `in_clasificacion_tipo_ent`='ANI'";
            }
            
            $resultado = $this->conexion->query($sql) or die($this->conexion->error);

            $resultado = $resultado->fetch_all(MYSQLI_ASSOC);

            // toda coneccion debe cerrarce una vez finalizada la consulta
            $this->cerrarConexion();
            return $resultado;
        } 
/*******************************************************************************************************************************************/        
        
        //INSERTAR usuario con nivel 2
        public function insertar_usuario_con_licencia($nombre,
                                                      $apellido,
                                                      $email,
                                                      $username,
                                                      $password,
                                                      $emailuser,
                                                      
                                                      $dni_enterprise, 
                                                      $nu_tipo_entidad_doc_ent,
                                                      $in_clasificacion_tipo_ent_doc_ent
                                                      ){
                                                          
            //echo ("nu_tipo_entidad_prf: /".$this->nombre."/ " );
            //echo ("nu_tipo_entidad_prf: /".$this->nu_tipo_entidad_prf."/ " );
            //echo ("in_clasificacion_tipo_ent_prf: /".$this->in_clasificacion_tipo_ent_prf."/" );

//echo ("insertar_usuario_con_licencia \n");
//echo ("nu_tipo_entidad_prf: ".$this->nu_tipo_entidad_prf." \n");

            $this->abrirConexion();
            
//************************************  nu_tipo_entidad_prf = 1 ****************************************** */
            if ($this->nu_tipo_entidad_prf==1){

//echo ("nu_tipo_entidad_prf==1");

                // creamos un nuevo dni, el ultimo valor valido 
                $sql = "SELECT MAX(dni) as dni FROM `enterprise`";

                $resultado = $this->conexion->query($sql) or die($this->conexion->error);
    
                $resultado = $resultado->fetch_all(MYSQLI_ASSOC);
    
                // lo guardamos en la variabl dni
                $dni= intval($resultado[0]['dni'])+1;

                
                $this->insertar("enterprise","$dni,5,'RUT',''");

                $this->insertar("persona","0,$dni,5,'RUT','','','','',''");
                
                $this->insertar("usuario","0, 
                                           0, 
                                           1, 
                                           'CDC',
                                           '$username', 
                                           '$password',
                                           '$emailuser',
                                           '$nu_tipo_entidad_prf',
                                           '$in_clasificacion_tipo_ent_prf',
                                           2,
                                           'INC',
                                           2,
                                           'NEG',
                                           $dni,
                                           5,
                                           'RUT'");

                $this->insertar("persona","0,0,1,'CDC','$nombre','$apellido','','','$emailuser'");
                
                $this->insertar("licencias","0,0,1,'CDC','$password','$emailuser',1,'ACT'");
                
                // plantilla temporal de tony
                $sql = "SELECT `nu_tipo_entidad`,
                               `in_clasificacion_tipo_ent`,
                               `nu_entidad`,
                               `in_clasificacion_ent`, 
                               `descripcion`,
                               `nu_tipo_entidad_sta`,
                               `in_clasificacion_tipo_ent_sta`,
                               `nu_tipo_entidad_pry`,
                               `in_clasificacion_tipo_ent_pry`
                            FROM `tipo_entidad`
                            where `dni_enterprise`='1' AND
                              `nu_tipo_entidad_doc_ent`=7 AND
                              `in_clasificacion_tipo_ent_doc_ent`='RIF' AND 
                              `nu_tipo_entidad_sta`=1 AND
                              `in_clasificacion_tipo_ent_sta` = 'ACT' AND 
                              `in_clasificacion_ent` in ('CNT','LOC','ALM')";

                $resultado = $this->conexion->query($sql) or die($this->conexion->error);
    
                $resultado = $resultado->fetch_all(MYSQLI_ASSOC);
    
                foreach($resultado as $Row)
                	{
                    $values=$Row['nu_tipo_entidad'].",".
                        "'".$Row['in_clasificacion_tipo_ent']."',".
                            $Row['nu_entidad'].",".
                        "'".$Row['in_clasificacion_ent']."',".
                        "'".$Row['descripcion']."',".
                        "'".$dni_enterprise."',".
                            $nu_tipo_entidad_doc_ent.",".
                        "'".$in_clasificacion_tipo_ent_doc_ent."',".
                            $Row['nu_tipo_entidad_sta'].",".
                        "'".$Row['in_clasificacion_tipo_ent_sta']."',".
                            $Row['nu_tipo_entidad_pry'].",".
                        "'".$Row['in_clasificacion_tipo_ent_pry']."'";
                    
                	$this->insertar("tipo_entidad",$values);
                	}


//************************************  nu_tipo_entidad_prf = 2 ****************************************** */
            }elseif($this->nu_tipo_entidad_prf==2){
                
                $sql1="INSERT INTO `persona`(`dni`,
                                            `nu_tipo_entidad_doc`,
                                            `in_clasificacion_tipo_ent_doc`, 
                                            `nombre`, 
                                            `apellido`, 
                                            `telefono`, 
                                            `direccion`, 
                                            `email`) 
                                        VALUES (0,
                                            1,
                                            'CDC',
                                            '$nombre',
                                            '$apellido',
                                            '',
                                            '',
                                            '$email')";

                $resultado = $this->conexion->query($sql1);
                
                if (!$resultado){
                    echo ("error guardar persona, no se Guardo");
                    die($this->conexion->error);
                }


                $usuario="INSERT INTO `usuario`(`ID_Usuario`,
                                            `dni`,
                                            `nu_tipo_entidad_doc`, 
                                            `in_clasificacion_tipo_ent_doc`, 
                                            `username`, 
                                            `password`, 
                                            `emailuser`, 
                                            `nu_tipo_entidad_prf`, 
                                            `in_clasificacion_tipo_ent_prf`, 
                                            `nu_tipo_entidad_sta`, 
                                            `in_clasificacion_tipo_ent_sta`, 
                                            `nu_tipo_entidad_set`, 
                                            `in_clasificacion_tipo_ent_set`, 
                                            `dni_enterprise`, 
                                            `nu_tipo_entidad_doc_ent`, 
                                            `in_clasificacion_tipo_ent_doc_ent`) 
                                        VALUES (null,
                                                0,
                                                1,
                                                'CDC',
                                                '$username',
                                                '$password',
                                                '$emailuser',
                                                3,
                                                'ANI',
                                                2,
                                                'INC',
                                                2,
                                                'NEG',
                                                '$dni_enterprise',
                                                $nu_tipo_entidad_doc_ent,
                                                '$in_clasificacion_tipo_ent_doc_ent')";
    //echo $usuario;

                $resultado = $this->conexion->query("$usuario") or die($this->conexion->error);

            }
            
            $this->cerrarConexion();            
            return $resultado ? true : false;
        }
        
    }


?>