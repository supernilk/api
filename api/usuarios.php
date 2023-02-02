<?php


   header('Access-Control-Allow-Origin: *');
   header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
   header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
   header("Allow: GET, POST, OPTIONS, PUT, DELETE");
   header("Content-Type: application/json");
   
   include_once("../clases/class_usuario.php");
   // Recibir las peticiones del usuario
   switch ($_SERVER['REQUEST_METHOD']){

        case 'GET':
            if(isset($_GET["tkn"])){
                //if(isset($_GET["consulta"]) && ($_GET["consulta"] =='Usuarios')){

                if (isset($_GET["buscar"])){
                    if (isset($_GET["dni_enterprise"]) &&
                        isset($_GET["nu_tipo_entidad_doc_ent"]) &&
                        isset($_GET["in_clasificacion_tipo_ent_doc_ent"])){
                        
                        $usuario = new Usuario();
                        if ($usuario->consultarToken($_GET["tkn"])){
                            http_response_code(200);
                            $raws = $usuario->consulta_Usuario($_GET["dni_enterprise"],
                                                               $_GET["nu_tipo_entidad_doc_ent"],
                                                               $_GET["in_clasificacion_tipo_ent_doc_ent"], 
                                                               $_GET["buscar"]);

                            echo (json_encode($raws));
                        }else{
                            // Toquen invalido
                            http_response_code(404);
                            $resultado["codigoResultado"] = "0";
                            $resultado["mensaje"] = "Acceso Denegado, token invalido";
                            echo json_encode($resultado);
                        }
                    }else{
                            // Faltan los datos de empresa
                            http_response_code(404);
                            $resultado["codigoResultado"] = "0";
                            $resultado["mensaje"] = "Faltan Datos de la empresa  (dni_enterprise,nu_tipo_entidad_doc_ent,in_clasificacion_tipo_ent_doc_ent)";
                            echo json_encode($resultado);
                    }
                    
                }elseif(isset($_GET["consulta"]) && ($_GET["consulta"] =='roles')){

                        $usuario = new Usuario();
                        if ($usuario->consultarToken($_GET["tkn"])){
                            http_response_code(200);
                            $raws = $usuario->consultar_roles();

                            echo (json_encode($raws));
                        }else{
                            // Toquen invalido
                            http_response_code(404);
                            $resultado["codigoResultado"] = "0";
                            $resultado["mensaje"] = "Acceso Denegado, token invalido";
                            echo json_encode($resultado);
                        }

                }else{
                    
                    if (isset($_GET["dni_enterprise"]) &&
                        isset($_GET["nu_tipo_entidad_doc_ent"]) &&
                        isset($_GET["in_clasificacion_tipo_ent_doc_ent"])){
                        
                        $usuario = new Usuario();
                        if ($usuario->consultarToken($_GET["tkn"])){
                            http_response_code(200);
                            $raws = $usuario->consultar_todos_Usuarios($_GET["dni_enterprise"],
                                                                       $_GET["nu_tipo_entidad_doc_ent"],
                                                                       $_GET["in_clasificacion_tipo_ent_doc_ent"]);

                            echo (json_encode($raws));
                        
                        }else{
                        
                            // Toquen invalido
                            http_response_code(404);
                            $resultado["codigoResultado"] = "0";
                            $resultado["mensaje"] = "Acceso Denegado, token invalido";
                            echo json_encode($resultado);
                        }
                        
                    }else{
                            // Faltan los datos de empresa
                            http_response_code(404);
                            $resultado["codigoResultado"] = "0";
                            $resultado["mensaje"] = "Faltan Datos de la empresa  (dni_enterprise,nu_tipo_entidad_doc_ent,in_clasificacion_tipo_ent_doc_ent)";
                            echo json_encode($resultado);
                    }
                }

            }
            
            
        break;
        

        case 'POST':
/**************************************************************************************/
            if (isset($_GET["consulta"]) && ($_GET["consulta"]=="insertar")){

                    if (isset($_GET["dni_enterprise"]) &&
                        isset($_GET["nu_tipo_entidad_doc_ent"]) &&
                        isset($_GET["in_clasificacion_tipo_ent_doc_ent"])){

                        $usuario = new Usuario();
                        if ($usuario->consultarToken($_GET["tkn"])){
                            http_response_code(200);
                            $raws = $usuario->insertar_usuario_con_licencia($_GET["nombre"],
                                                                            $_GET["apellido"],
                                                                            $_GET["email"],
                                                                            $_GET["username"],
                                                                            $_GET["password"],
                                                                            $_GET["emailuser"],
                                                      
                                                                            $_GET["dni_enterprise"],
                                                                            $_GET["nu_tipo_entidad_doc_ent"],
                                                                            $_GET["in_clasificacion_tipo_ent_doc_ent"]
                                                                            );

                            echo (json_encode($raws));
                        }else{
                            // Toquen invalido
                            http_response_code(404);
                            $resultado["codigoResultado"] = "0";
                            $resultado["mensaje"] = "Acceso Denegado, token invalido";
                            echo json_encode($resultado);
                        }
                        
                            
                    }else{
                            // Faltan los datos de empresa
                            http_response_code(404);
                            $resultado["codigoResultado"] = "0";
                            $resultado["mensaje"] = "Faltan Datos de la empresa  (dni_enterprise,nu_tipo_entidad_doc_ent,in_clasificacion_tipo_ent_doc_ent)";
                            echo json_encode($resultado);
                    }
/**************************************************************************************/
            // Logueo 
            }elseif(isset($_POST["correo"])){
                // Recibimos un Correo
                if (isset($_POST["password"])){

                    $usuario = new Usuario();
                    $usuario->set_Correo($_POST["correo"]);
                    $usuario->set_Password($_POST["password"]);

                    if ($usuario->consultarUsuario()){
                        http_response_code(200);

                        $resultado=array(
                            "token"=>$usuario->get_Token(),
                            "codigoResultado"=>"1",
                            "mensaje" => "Usuario autenticado",
                            "usuario" => array(
                                "nombre" => $usuario->get_Nombre(),
                                "correo" => $usuario->get_Correo(),
                                "nu_tipo_entidad_prf" => $usuario-> nu_tipo_entidad_prf,
                                "in_clasificacion_tipo_ent_prf" => $usuario-> in_clasificacion_tipo_ent_prf,
                                
                                "dni_enterprise" => $usuario-> dni_enterprise,
                                "nu_tipo_entidad_doc_ent" => $usuario->nu_tipo_entidad_doc_ent,
                                "in_clasificacion_tipo_ent_doc_ent" => $usuario-> in_clasificacion_tipo_ent_doc_ent

                                )
                            );                                

                        echo json_encode($resultado);

                    }else{
                        $resultado["codigoResultado"] = "0";
                        $resultado["mensaje"] = "Usuario/Password incorrectos";
                        echo json_encode($resultado);
                    }

                    }else{
                    // incorrecto tiene usuario falta clave
                    $resultado["mensaje"] = "Error, Indique password del usuario";
                    echo json_encode($resultado);
                }
                    
            }else{
                // no se ha recibido ningun correo
                $resultado["mensaje"] = "Error Indique el correo a consultar";
                echo json_encode($resultado);

            }
        break;


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