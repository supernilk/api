<?php

    class Usuario {
        private $ID_usuario;
        private $nombre;
        private $correo;
        private $password;
        private $token;

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
            $resultado = $this->conexion->query("INSERT INTO $tabla VALUES (null,$datos)") or die($this->conexion->error);
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

            $sql="SELECT * FROM token t JOIN usuario u ON t.ID_Usuario=u.ID_Usuario WHERE t.token ='$token_a_comparar'";
            //print_r($sql);
            $resultado = $this->conexion->query($sql) or die($this->conexion->error);

            $resultado = count($resultado->fetch_all(MYSQLI_ASSOC));
            //print_r($resultado[0]["username"]);

            if ($resultado>0){
                $this->ID_usuario=intval($resultado[0]["ID_Usuario"]);
                $this->nombre=$resultado[0]["username"];
            }
            //print_r($resultado);
            //print_r(count($resultado));
            
            $this->cerrarConexion();
            return $resultado > 0 ? true : false;
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

        public function consultarUsuario()
        {       
            // abrimos la coneccion para hacer la consulta a la bd
            $this->abrirConexion();
            // me crea una array asosiativo de los elemento a consultar
            // https://www.tutorialspoint.com/php/php_function_mysqli_fetch_all.htm
            $rows = $this->buscar("usuario","emailuser = '".$this->correo."' and ".
                                    "password = '".$this->password."'");
            /*
            print_r($rows);

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
    }
    







?>