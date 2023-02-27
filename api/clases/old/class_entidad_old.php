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
                         nu_tipo_entidad > 0";

            $resultado = $this->conexion->query($sql) or die($this->conexion->error);

            $resultado = $resultado->fetch_all(MYSQLI_ASSOC);

            // toda coneccion debe cerrarce una vez finalizada la consulta
            $this->cerrarConexion();
            return $resultado;
        }
        
        public function consultarEntidad($descripcion)
        {       
            $this->abrirConexion();

            $sql="SELECT nu_entidad, in_clasificacion_ent, nu_tipo_entidad, in_clasificacion_tipo_ent, descripcion FROM tipo_entidad WHERE 
                         in_clasificacion_ent in ('CNT','ALM','LOC') and
                         nu_tipo_entidad > 0 and descripcion like '%$descripcion%' ";

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
        
        
    }


?>