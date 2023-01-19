<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");
    header("Content-Type: application/json");
    
    include_once("../clases/class_entidad.php");
    // Recibir las peticiones del usuario

    switch ($_SERVER['REQUEST_METHOD']){

        case 'GET':
            // se recibe un Json con los datos
            
            //if(isset($_GET["tkn"])){
            //    echo ("token: por Get".$_GET["tkn"]);
            //};
            
            //if(isset($_POST["tkn"])){
            //    echo ("token: por post".$_POST["tkn"]);
            //};

            //$_POST = json_decode( file_get_contents('php://input'),true);

            //if (isset($_POST["token"])){
            if(isset($_GET["tkn"])){                

                $entidad = new Entidad();
                if ($entidad->consultarToken($_GET["tkn"])){
                    http_response_code(200);
                    $raws = $entidad->consultarEntidades();
                    echo ( json_encode($raws));
                }else{
                    // Toquen invalido
                    http_response_code(404);
                    $resultado["codigoResultado"] = "0";
                    $resultado["mensaje"] = "Acceso Denegado";
                    echo json_encode($resultado);
                }
                
            }else{
                // no venvio el token
                http_response_code(404);
                $resultado["codigoResultado"] = "0";
                $resultado["mensaje"] = "Acceso Denegado";
                echo json_encode($resultado);

            }
        break;
        
        
        case 'POST':
            //convertimos el json en array descriptivo
            

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