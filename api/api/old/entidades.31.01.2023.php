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

            if(isset($_GET["tkn"])){

/****************************************************** consulta -> TipoEntidades **********************************************/   

                if(isset($_GET["consulta"]) && ($_GET["consulta"] =='TipoEntidades')){
                    
                    $entidad = new Entidad();
                    if ($entidad->consultarToken($_GET["tkn"])){
                        http_response_code(200);
                        $raws = $entidad->consultarTipoEntidad();
                        echo ( json_encode($raws));
                    }else{
                        // Toquen invalido
                        http_response_code(404);
                        $resultado["codigoResultado"] = "0";
                        $resultado["mensaje"] = "Acceso Denegado";
                        echo json_encode($resultado);
                    }

/****************************************************** consulta -> Proyecto **********************************************/  

                }elseif(isset($_GET["consulta"]) && ($_GET["consulta"] =='Proyecto')
                                                 && (isset($_GET["dni_enterprise"]))
                                                 && (isset($_GET["nu_tipo_entidad_doc_ent"]))
                                                 && (isset($_GET["in_clasificacion_tipo_ent_doc_ent"]))
                                                    ){

                    $entidad = new Entidad();
                    if ($entidad->consultarToken($_GET["tkn"])){
                        http_response_code(200);
                        $raws = $entidad->consultarProyecto($_GET["dni_enterprise"],
                                                            $_GET["nu_tipo_entidad_doc_ent"],
                                                            $_GET["in_clasificacion_tipo_ent_doc_ent"]);
                        echo ( json_encode($raws));
                    }else{
                        // Toquen invalido
                        http_response_code(404);
                        $resultado["codigoResultado"] = "0";
                        $resultado["mensaje"] = "Acceso Denegado";
                        echo json_encode($resultado);
                    }
                    
/****************************************************** consulta -> filtrar_por_descripcion ********************************/  

                }elseif(isset($_GET["consulta"]) && ($_GET["consulta"] =='filtrar_por_descripcion')
                                                 && (isset($_GET["dni_enterprise"]))
                                                 && (isset($_GET["nu_tipo_entidad_doc_ent"]))
                                                 && (isset($_GET["in_clasificacion_tipo_ent_doc_ent"]))
                                                    ){
                    
                    $entidad = new Entidad();
                    if ($entidad->consultarToken($_GET["tkn"])){
                        http_response_code(200);
                        $raws = $entidad->consultarEntidad($_GET["filtrar_por_descripcion"],
                                                           $_GET["dni_enterprise"],
                                                           $_GET["nu_tipo_entidad_doc_ent"],
                                                           $_GET["in_clasificacion_tipo_ent_doc_ent"]);
                        echo ( json_encode($raws));
                    }else{
                        // Toquen invalido
                        http_response_code(404);
                        $resultado["codigoResultado"] = "0";
                        $resultado["mensaje"] = "Acceso Denegado";
                        echo json_encode($resultado);
                    }

/****************************************************** consulta -> filtrar_por_proyecto ********************************/  

                }elseif(isset($_GET["consulta"]) && ($_GET["consulta"] =='filtrar_por_proyecto')
                                                              && (isset($_GET["dni_enterprise"]))
                                                              && (isset($_GET["nu_tipo_entidad_doc_ent"]))
                                                              && (isset($_GET["in_clasificacion_tipo_ent_doc_ent"]))
                                                              ){
                    
                    $entidad = new Entidad();
                    if ($entidad->consultarToken($_GET["tkn"])){
                        http_response_code(200);
                        $raws = $entidad->filtrar_entidades_por_proyecto($_GET["nu_tipo_entidad_pry"],
                                                                         $_GET["in_clasificacion_tipo_ent_pry"],
                                                                         $_GET["dni_enterprise"], 
                                                                         $_GET["nu_tipo_entidad_doc_ent"],
                                                                         $_GET["in_clasificacion_tipo_ent_doc_ent"]
                                                                         );
                        echo ( json_encode($raws));
                    }else{
                        // Toquen invalido
                        http_response_code(404);
                        $resultado["codigoResultado"] = "0";
                        $resultado["mensaje"] = "Acceso Denegado";
                        echo json_encode($resultado);
                    }
                    
                }else{

/********************************************************* consultar todas las Entidades ******************************************************/                    

                    if (isset($_GET["tkn"]) && isset($_GET["dni_enterprise"]) && isset($_GET["nu_tipo_entidad_doc_ent"]) && isset($_GET["in_clasificacion_tipo_ent_doc_ent"]) ){
                        // cuando solo se recibe token
                        $entidad = new Entidad();
                        if ($entidad->consultarToken($_GET["tkn"])){
                            http_response_code(200);
                            
                            $entidad->dni_enterprise = $_GET["dni_enterprise"];
                            $entidad->nu_tipo_entidad_doc_ent = $_GET["nu_tipo_entidad_doc_ent"];
                            $entidad->in_clasificacion_tipo_ent_doc_ent = $_GET["in_clasificacion_tipo_ent_doc_ent"];
                            
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
                            // Toquen invalido
                            http_response_code(404);
                            $resultado["codigoResultado"] = "0";
                            $resultado["mensaje"] = "Acceso Denegado, Token invalido, o faltan valores de la empresa";
                            echo json_encode($resultado);
                    }
                }
                
            }else{

/*---------------------------------------------------------- no envio el token -------------------------------------------------------*/
/*  si entra aqui es por que no se envio la palabra tkn como parametro requerido para cualquier consulta*/

                http_response_code(404);
                $resultado["codigoResultado"] = "0";
                $resultado["mensaje"] = "Acceso Denegado";
                echo json_encode($resultado);

            }
        break;
        
        
        case 'POST':
/****************************************************** consulta -> Insertar *****************************************************/  

            if(isset($_POST["consulta"]) && ($_POST["consulta"] =='Insertar')){
                    
                if ($entidad->consultarToken($_POST["tkn"])){

                    $entidad = new Entidad();
                    
                    $consulta = $entidad->insertarEntidad($_POST["nu_entidad"], 
                                                          $_POST["in_clasificacion_ent"],
                                                          $_POST["descripcion"],
                                                          $_POST["dni_enterprise"],
                                                          $_POST["nu_tipo_entidad_doc_ent"],
                                                          $_POST["in_clasificacion_tipo_ent_doc_ent"],
                                                          $_POST["nu_tipo_entidad_pry"],
                                                          $_POST["in_clasificacion_tipo_ent_pry"]
                                                          );


                    echo json_encode($resultado);

                }else{
                    // Toquen invalido, no esta autorizado
                    http_response_code(401);
                    $resultado["codigoResultado"] = "0";
                    $resultado["mensaje"] = "Acceso Denegado";
                    echo json_encode($resultado);
                }                    
            }
    
        break;

        case 'PUT':

/****************************************************** consulta -> Insertar *****************************************************/  

            if(isset($_GET["consulta"]) && ($_GET["consulta"] =='Actualizar')){
                $entidad = new Entidad();
                
                if ($entidad->consultarToken($_GET["tkn"])){
                    $consulta = $entidad->actualizarEntidad($_GET["descripcion"], 
                                                            $_GET["nu_tipo_entidad"],
                                                            $_GET["in_clasificacion_tipo_ent"],
                                                            $_GET["nu_entidad"],
                                                            $_GET["in_clasificacion_ent"],
                                                            $_GET["nu_tipo_entidad_pry"],
                                                            $_GET["in_clasificacion_tipo_ent_pry"],
                                                            $_GET["dni_enterprise"],
                                                            $_GET["nu_tipo_entidad_doc_ent"],
                                                            $_GET["in_clasificacion_tipo_ent_doc_ent"]
                                                            );

                        if ($consulta){
                            http_response_code(200);
                            $resultado["codigoResultado"] = "1";
                            $resultado["mensaje"] = "Actualizacion Correcta";
                        }else{
                            http_response_code(404);
                            $resultado["codigoResultado"] = "0";
                            $resultado["mensaje"] = "Error en la Actualizacion";
                        }
                        
                        echo json_encode($resultado);

                    }else{
                        // Toquen invalido, no esta autorizado
                        http_response_code(401);
                        $resultado["codigoResultado"] = "0";
                        $resultado["mensaje"] = "Acceso Denegado";
                        echo json_encode($resultado);
                    }                    

            }


        break;

        case 'DELETE':

/****************************************************** consulta -> Eliminar *****************************************************/  
            
            
            
            if(isset($_GET["consulta"]) && ($_GET["consulta"] =='Eliminar')){
            
                $entidad = new Entidad();
                
                if ($entidad->consultarToken($_GET["tkn"])){
                    
                    $consulta = $entidad->borrarEntidad($_GET["nu_tipo_entidad"], 
                                                        $_GET["in_clasificacion_tipo_ent"], 
                                                        $_GET["nu_entidad"], 
                                                        $_GET["in_clasificacion_ent"],
                                                        $_GET["dni_enterprise"], 
                                                        $_GET["nu_tipo_entidad_doc_ent"],
                                                        $_GET["in_clasificacion_tipo_ent_doc_ent"]);
    
                    if ($consulta){
                        http_response_code(200);
                        $resultado["codigoResultado"] = "1";
                        $resultado["mensaje"] = "Eliminacion Correcta";
                    }else{
                        http_response_code(404);
                        $resultado["codigoResultado"] = "0";
                        $resultado["mensaje"] = "Error en la Eliminacion";
                    }
                    
                }else{
                    // Toquen invalido, no esta autorizado
                    http_response_code(401);
                    $resultado["codigoResultado"] = "0";
                    $resultado["mensaje"] = "Acceso Denegado";
                    echo json_encode($resultado);
                }
                
            echo json_encode($resultado);                                                        
              
            }
                      
        break;
        default:
            echo "Error Metodo Request No aceptado";
    }
    
?>