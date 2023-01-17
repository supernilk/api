<?php


   header('Access-Control-Allow-Origin: *');
   header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
   header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
   header("Allow: GET, POST, OPTIONS, PUT, DELETE");
   header("Content-Type: application/json");
   
   include_once("../clases/class_usuario.php");
   // Recibir las peticiones del usuario

   function str_rand(int $length = 64){ // 64 = 32
    $length = ($length < 4) ? 4 : $length;
    return bin2hex(random_bytes(($length-($length%2))/2));  
    }

   switch ($_SERVER['REQUEST_METHOD']){

        
        case 'GET':

        break;
        
        // pendiente que se envie el json con los datos validos, no null
        // Crear Uruario
        // se recibe un Json con los datos
        case 'POST':
            //echo 'informacion: '. file_get_contents('php://input')."\n";
            $_POST = json_decode( file_get_contents('php://input'),true);
            //echo "Nuevo Correo: " . $_POST['correo'];
            
            ///$resultado["mensaje"] = "Guardar usuario, informacion:"///.json_encode($_POST);
            ///echo json_encode($resultado);
            // se recibe un correo y password del usuario a consultar      
            
            if(isset($_POST["correo"])){
                // Recibimos un Correo
                
                if (isset($_POST["password"])){

                    $usuario = new Usuario();
                    $usuario->set_Correo($_POST["correo"]);
                    $usuario->set_Password($_POST["password"]);

                    if ($usuario->consultarUsuario()){
                        http_response_code(200);
                        //$resultado["token"] = sha1(uniqid(rand()),true);
                        //$resultado["token"] = str_rand();
                        $resultado["token"] = $usuario->get_Token();
                        $resultado["codigoResultado"] = "1";
                        $resultado["mensaje"] = "Usuario autenticado";
                        
                        $usuarioDatos["nombre"]= $usuario->get_Nombre();
                        $usuarioDatos["correo"]= $usuario->get_Correo();
                        
                        $resultado["usuario"]= $usuarioDatos;
                        
                        echo json_encode($resultado);
                    }else{
                        http_response_code(404);
                        $resultado["codigoResultado"] = "0";
                        $resultado["mensaje"] = "Usuario/Password incorrectos";
                        echo json_encode($resultado);
                    }

                    }else{
                    http_response_code(400);
                    // incorrecto tiene usuario falta clave
                    $resultado["mensaje"] = "Error, Indique password del usuario";
                    echo json_encode($resultado);
                }
                    
            }else{
                http_response_code(400);
                // no se ha recibido ningun correo
                $resultado["mensaje"] = "Error Indique el correo a consultar";
                echo json_encode($resultado);
            }
            /****/
        break;

        // pendiente si el metodo es delete pero no manda json, y verificar que los datos son validos, no null
        // Actualizar un Usuario
        // se recibe un Json con los datos
        case 'PUT':
            //echo 'informacion: '. file_get_contents('php://input')."\n";
            $_PUT = json_decode( file_get_contents('php://input'),true);
            $resultado["mensaje"] = "Actualiza Datos del Usuario con el id: ".$_GET['id']. 
                                    ", Informacion".json_encode($_PUT);
            echo json_encode($resultado);

            //echo "Actualiza Datos del Usuario: id: ".$_GET['id'];
        break;


        // pendiente si el metodo es delete pero no manda id
        // Eliminar un Usuario
        // se envia un id del usuario a consultar
        case 'DELETE':
            $resultado["mensaje"] = "Eliminar el Usuario con el id: ".$_GET['id'];
            echo json_encode($resultado);

            //echo "Borrar Datos del Usuario: id: ".$_GET['id'];
        break;
        default:
            echo "Error Metodo Request No aceptado";
    }
    

    

    

  

    

?>