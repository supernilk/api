<?php

    class Entidad {

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
            $resultado = $this->conexion->query("INSERT INTO $tabla VALUES (null,$datos)") or die($this->conexion->error);
            return $resultado ? true : false;
        }

        //BORRAR en la BD
        public function borrar($tabla,$condicion){
            $resultado = $this->conexion->query("INSERT INTO $tabla VALUES (null,$condicion)") or die($this->conexion->error);
            return $resultado ? true : false;
        }

        public function consultarToken($token_a_comparar)
        {
            $this->abrirConexion();

            $sql="SELECT * FROM token t JOIN usuario u ON t.ID_Usuario=u.ID_Usuario WHERE t.token ='$token_a_comparar'";
            //print_r($sql);
            $resultado = $this->conexion->query($sql) or die($this->conexion->error);

            $resultado = count($resultado->fetch_all(MYSQLI_ASSOC));
            //print_r($resultado[0]["username"]);

            $this->cerrarConexion();
            return $resultado > 0 ? true : false;
        }

        //ACTUALIZAR en la BD
        public function actualizar($tabla,$campos,$condicion){
            $resultado = $this->conexion->query("UPDATE $tabla SET $campos where $condicion") or die($this->conexion->error);
            return $resultado ? true : false;
        }

        public function consultarEntidades()
        {       
            $this->abrirConexion();

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
        
        public function consultarEntidad($descripcion, 
                                         $dni_enterprise, 
                                         $nu_tipo_entidad_doc_ent,
                                         $in_clasificacion_tipo_ent_doc_ent)
        {       
            $this->abrirConexion();

            $sql="SELECT nu_entidad, in_clasificacion_ent, nu_tipo_entidad, in_clasificacion_tipo_ent, descripcion FROM tipo_entidad 
                    WHERE in_clasificacion_ent in ('CNT','ALM','LOC') AND
                         nu_tipo_entidad > 0 AND  
                         dni_enterprise='$dni_enterprise' AND
                         nu_tipo_entidad_doc_ent= $nu_tipo_entidad_doc_ent AND
                         in_clasificacion_tipo_ent_doc_ent = '$in_clasificacion_tipo_ent_doc_ent' AND
                         descripcion like '%$descripcion%' AND
                         nu_tipo_entidad_sta=1 AND 
                         in_clasificacion_tipo_ent_sta='ACT' ";
            
            //echo ($sql);
    
            $resultado = $this->conexion->query($sql) or die($this->conexion->error);

            $resultado = $resultado->fetch_all(MYSQLI_ASSOC);

            // toda coneccion debe cerrarce una vez finalizada la consulta
            $this->cerrarConexion();
            return $resultado;
        }

        public function consultarTipoEntidad()
        {       
            $this->abrirConexion();

            $sql="select nu_entidad, in_clasificacion_ent,descripcion from entidad where in_clasificacion_ent in ('CNT','ALM','LOC')";

            $resultado = $this->conexion->query($sql) or die($this->conexion->error);

            $resultado = $resultado->fetch_all(MYSQLI_ASSOC);

            // toda coneccion debe cerrarce una vez finalizada la consulta
            $this->cerrarConexion();
            return $resultado;
        }
        
        public function insertarEntidad($nu_entidad, 
                                        $in_clasificacion_ent, 
                                        $descripcion,
                                        $dni_enterprise,
                                        $nu_tipo_entidad_doc_ent,
                                        $in_clasificacion_tipo_ent_doc_ent,
                                        $nu_tipo_entidad_pry,
                                        $in_clasificacion_tipo_ent_pry
                                        )
        {       
            
            //echo ("nu_entidad: $nu_entidad, in_clasificacion_ent: $in_clasificacion_ent, descripcion: $descripcion");
            
            $this->abrirConexion();

            //$resultado = $this->conexion->query("UPDATE $tabla SET $campos where $condicion") or die($this->conexion->error);
            // calcular el valor de nu_tipo_entidad
            $nu_tipo_entidad=0;
            
            $sql = "SELECT max(nu_tipo_entidad) AS valorMax FROM `tipo_entidad` WHERE nu_entidad = '$nu_entidad' AND
                                                                                     `in_clasificacion_ent` = '$in_clasificacion_ent' AND
                                                                                      dni_enterprise = '$dni_enterprise' AND 
                                                                                      nu_tipo_entidad_doc_ent = $nu_tipo_entidad_doc_ent AND 
                                                                                      in_clasificacion_tipo_ent_doc_ent = '$in_clasificacion_tipo_ent_doc_ent'
            ";
            
            //print_r($sql);
            
            $resultado = $this->conexion->query($sql) or die($this->conexion->error);

            $resultado = $resultado->fetch_all(MYSQLI_ASSOC);

            $nu_tipo_entidad= intval($resultado[0]['valorMax'])+1;

            $sql="INSERT INTO tipo_entidad VALUES ($nu_tipo_entidad,
                                                  '$in_clasificacion_ent',
                                                   $nu_entidad, 
                                                  '$in_clasificacion_ent',
                                                  '$descripcion', 
                                                  '$dni_enterprise', 
                                                   $nu_tipo_entidad_doc_ent,
                                                  '$in_clasificacion_tipo_ent_doc_ent',
                                                  1,
                                                  'ACT',
                                                  $nu_tipo_entidad_pry,
                                                  '$in_clasificacion_tipo_ent_pry'
                                                  )";
            //print_r ($sql);
            $resultado = $this->conexion->query($sql); //or die($this->conexion->error);


            if($this->conexion->affected_rows > 0){
                    return true;
                }else{
                    return false;
                }
            
            $this->cerrarConexion();
        }

        public function actualizarEntidad($descripcion,
                                          $nu_tipo_entidad, 
                                          $in_clasificacion_tipo_ent, 
                                          $nu_entidad, 
                                          $in_clasificacion_ent,
                                          $nu_tipo_entidad_pry,
                                          $in_clasificacion_tipo_ent_pry,
                                          $dni_enterprise, 
                                          $nu_tipo_entidad_doc_ent,
                                          $in_clasificacion_tipo_ent_doc_ent
                                          )
        {       

            $this->abrirConexion();

            $sql="UPDATE tipo_entidad SET descripcion = '$descripcion',
	   					nu_tipo_entidad_pry = $nu_tipo_entidad_pry,
                        in_clasificacion_tipo_ent_pry = '$in_clasificacion_tipo_ent_pry'
				  WHERE nu_tipo_entidad = $nu_tipo_entidad AND
                    	in_clasificacion_tipo_ent = '$in_clasificacion_tipo_ent' AND
                    	nu_entidad = $nu_entidad AND 
                    	in_clasificacion_ent = '$in_clasificacion_ent' AND 
                    	dni_enterprise = '$dni_enterprise' AND
                    	nu_tipo_entidad_doc_ent = $nu_tipo_entidad_doc_ent AND 
                    	in_clasificacion_tipo_ent_doc_ent = '$in_clasificacion_tipo_ent_doc_ent'";
            
            //print_r($sql);
            
            $this->conexion->query($sql); //or die($this->conexion->error);


            if($this->conexion->affected_rows > 0){
                    return true;
                }else{
                    return false;
                }
            
            $this->cerrarConexion();
        }
        
        function consultarProyecto($dni_enterprise,$nu_tipo_entidad_doc_ent,$in_clasificacion_tipo_ent_doc_ent){

        $this->abrirConexion();
        $sql = "select nu_tipo_entidad as nu_tipo_entidad_pry, in_clasificacion_tipo_ent as in_clasificacion_tipo_ent_pry, descripcion 
                from tipo_entidad 
                where nu_entidad = 14 AND
                in_clasificacion_ent='PRY' AND 
                dni_enterprise='$dni_enterprise' AND 
                nu_tipo_entidad_doc_ent = $nu_tipo_entidad_doc_ent AND 
                in_clasificacion_tipo_ent_doc_ent= '$in_clasificacion_tipo_ent_doc_ent' order by nu_tipo_entidad";

        $resultado = $this->conexion->query($sql) or die($this->conexion->error);
        $resultado = $resultado->fetch_all(MYSQLI_ASSOC);
    
        // toda coneccion debe cerrarce una vez finalizada la consulta
        $this->cerrarConexion();
        return $resultado;
        }
        
        function borrarEntidad($nu_tipo_entidad, 
                               $in_clasificacion_tipo_ent, 
                               $nu_entidad, 
                               $in_clasificacion_ent,
                               
                               $dni_enterprise, 
                               $nu_tipo_entidad_doc_ent,
                               $in_clasificacion_tipo_ent_doc_ent){

        $this->abrirConexion();
        $sql = "UPDATE tipo_entidad SET nu_tipo_entidad_sta=2,in_clasificacion_tipo_ent_sta='INC'
                    WHERE nu_tipo_entidad=$nu_tipo_entidad AND
                    in_clasificacion_tipo_ent='$in_clasificacion_tipo_ent' AND
                    nu_entidad=$nu_entidad AND
                    in_clasificacion_ent='$in_clasificacion_ent' AND
                    dni_enterprise='$dni_enterprise' AND
                    nu_tipo_entidad_doc_ent=$nu_tipo_entidad_doc_ent AND
                    in_clasificacion_tipo_ent_doc_ent='$in_clasificacion_tipo_ent_doc_ent'";

        //print_r($sql);
        
           $this->conexion->query($sql); //or die($this->conexion->error);

            if($this->conexion->affected_rows > 0){
                    return true;
                }else{
                    return false;
                }
            
            $this->cerrarConexion();

        }
        
        function filtrar_entidades_por_proyecto($nu_tipo_entidad_pry,
                                                $in_clasificacion_tipo_ent_pry,
                                                $dni_enterprise, 
                                                $nu_tipo_entidad_doc_ent,
                                                $in_clasificacion_tipo_ent_doc_ent
                                                ){
                                                    
            $this->abrirConexion();
            
            $sql="SELECT nu_tipo_entidad,in_clasificacion_tipo_ent,nu_entidad,in_clasificacion_ent, `dni_enterprise` from tipo_entidad 
                        WHERE 
                            nu_tipo_entidad_pry=$nu_tipo_entidad_pry AND
                            in_clasificacion_tipo_ent_pry='$in_clasificacion_tipo_ent_pry' AND
                            dni_enterprise='$dni_enterprise' AND
                            nu_tipo_entidad_doc_ent=$nu_tipo_entidad_doc_ent AND
                            in_clasificacion_tipo_ent_doc_ent='$in_clasificacion_tipo_ent_doc_ent' AND 
                            nu_tipo_entidad > 0 AND
                            nu_tipo_entidad_sta=1 AND 
                            in_clasificacion_tipo_ent_sta='ACT'
                        ORDER BY nu_entidad,nu_tipo_entidad";

        //echo($sql);
    
            $resultado = $this->conexion->query($sql) or die($this->conexion->error);

            $resultado = $resultado->fetch_all(MYSQLI_ASSOC);

            // toda coneccion debe cerrarce una vez finalizada la consulta
            $this->cerrarConexion();
            return $resultado;

        }
    }


?>