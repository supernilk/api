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
                    
                }elseif(isset($_GET["consulta"]) && ($_GET["consulta"] =='Roles')){

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
                
                    
                }elseif(isset($_GET["consulta"]) && ($_GET["consulta"] =='Status de Usuario')){
                // lista de status de usuario

                    $usuario = new Usuario();
                    $resultado= $usuario->status_d_usuario();
                    echo json_encode($resultado);

                }elseif(isset($_GET["consulta"]) && ($_GET["consulta"] =='usuarios de superadmin')){
/*********************************************************************************************************************************/
                    $usuario = new Usuario();
                    if ($usuario->consultarToken($_GET["tkn"])){                       
                        if ($usuario->nu_tipo_entidad_prf==1) {
                             //echo "usuarios de superadmin";
                             $raws = $usuario->consultar_usuarios_de_superadmin(); 
                             echo (json_encode($raws));
                        }else{
                        
                            // Toquen invalido
                            http_response_code(404);
                            $resultado["codigoResultado"] = "0";
                            $resultado["mensaje"] = "Acceso Denegado, token invalido";
                            echo json_encode($resultado);
                        }
                    }
                }
            }

        break;
        

        case 'POST':
/**************************************************************************************/

            // revisamos que tiene token
            if (isset($_GET["tkn"])) {
                $usuario = new Usuario();
                if ($usuario->consultarToken($_GET["tkn"])){                       
                    // aqui obtenemos el su rango
//                    echo ("nombre:".$usuario->get_Nombre()." nu_tipo_entidad_prf:".$usuario->nu_tipo_entidad_prf."\n");
                    
                    if (isset($_GET["consulta"]) && ($_GET["consulta"]=="Insertar")){
                        
                        switch ($usuario->nu_tipo_entidad_prf) {
                            case 1:
                                //echo "el usuario es SuperAdmin"." \n";

                                    if (isset($_GET["nu_tipo_entidad_prf"])) { 

                                        if ($_GET["nu_tipo_entidad_prf"]==1||$_GET["nu_tipo_entidad_prf"]==2){
                                            // vamo a insertar tipo 1 o tipo 2
                                            // proceso 2
                                            //echo "entrando a proceso2---\n";
                                            if (isset($_GET["fecha"])){
                                                //echo "fecha es:".$_GET["fecha"]."\n";
                                                
                                                $fecha = strtotime($_GET["fecha"]);
                                                //echo ("tiempo: $fecha".date("d-m-Y h:i:s a", $fecha));

                                                if ($usuario->proceso2($_GET["nombreEmpresa"],
                                                                       $_GET["nombre"],
                                                                       $_GET["apellido"],
                                                                       $_GET["email"],
                                                                       $_GET["username"],
                                                                       $_GET["password"],
                                                                       $fecha,
        
                                                                       $_GET["nu_tipo_entidad_prf"],
                                                                       $_GET["in_clasificacion_tipo_ent_prf"])){
                           
                                                    http_response_code(200);
                                                    $resultado["codigoResultado"] = "1";
                                                    $resultado["mensaje"] = "Insercion realizada con exito";
                                                    
                                                    echo json_encode($resultado);
                                                }else{
                                                    http_response_code(404);
                                                    $resultado["codigoResultado"] = "0";
                                                    $resultado["mensaje"] = "Error en la Insercion";
                                                    
                                                    echo json_encode($resultado);
                                                }
                                                
                                                
                                            }else{
                                                echo "falta la fecha";
                                            }
                                        }
                                        
                                        if ($_GET["nu_tipo_entidad_prf"]==3){
                                            // vamos a insertar tipo 3
                                            // proceso 1
                                            //echo "entrando a proceso1****\n";
                                            if ($usuario->proceso1($_GET["nombre"],
                                                                   $_GET["apellido"],
                                                                   $_GET["email"],
                                                                   $_GET["username"],
                                                                   $_GET["password"],
                                                               
                                                                   $_GET["nu_tipo_entidad_pry"],
                                                                   $_GET["in_clasificacion_tipo_ent_pry"],

                                                                   $usuario->dni_enterprise, 
                                                                   $usuario->nu_tipo_entidad_doc_ent,
                                                                   $usuario->in_clasificacion_tipo_ent_doc_ent)){
                                                               
                                                    http_response_code(200);
                                                    $resultado["codigoResultado"] = "1";
                                                    $resultado["mensaje"] = "Insercion realizada con exito";
                                                    
                                                    echo json_encode($resultado);
                                                }else{
                                                    http_response_code(404);
                                                    $resultado["codigoResultado"] = "0";
                                                    $resultado["mensaje"] = "Error en la Insercion";
                                                    
                                                    if ($usuario->nu_error)
                                                        $resultado["error"] = $usuario->str_error;

                                                    echo json_encode($resultado);
                                                }

                                        }
                                    }
                                
                                break;
                                
                            case 2:
                                //echo "el usuario es UserAdmin"." \n";
                                if (isset($_GET["nu_tipo_entidad_prf"]) && isset($_GET["in_clasificacion_tipo_ent_prf"])){
                                
                                    if ($_GET["nu_tipo_entidad_prf"]==3) { 
                                        //echo "fecha------->".$usuario->fecha_exp_lic."<--------";
                                        // vamos a insertar tipo 3
                                        // proceso 1
                                         
                                        if ($usuario->proceso1($_GET["nombre"],
                                                           $_GET["apellido"],
                                                           $_GET["email"],
                                                           $_GET["username"],
                                                           $_GET["password"],
                                                           
                                                           $_GET["nu_tipo_entidad_pry"],
                                                           $_GET["in_clasificacion_tipo_ent_pry"],

                                                           $_GET["dni_enterprise"], 
                                                           $_GET["nu_tipo_entidad_doc_ent"],
                                                           $_GET["in_clasificacion_tipo_ent_doc_ent"])){
                                                    
                                                    http_response_code(200);
                                                    $resultado["codigoResultado"] = "1";
                                                    $resultado["mensaje"] = "Insercion realizada con exito";
                                                    
                                                    echo json_encode($resultado);                                                               
                                            }else{
                                                    http_response_code(404);
                                                    $resultado["codigoResultado"] = "0";
                                                    $resultado["mensaje"] = "Error en la Insercion";
                                                    
                                                    if ($usuario->nu_error)
                                                        $resultado["error"] = $usuario->str_error;

                                                    echo json_encode($resultado);
                                                }
                                        
                                    }else{
                                        // mostrar error: solo puede agregar Analista de Inventario
                                        echo "error: solo puede agregar Analista de Inventario"." \n";
                                    }

                                }else{
                                    echo "falta ingresar: nu_tipo_entidad_prf o in_clasificacion_tipo_ent_prf"." \n";
                                }
                                
                                break;
                                
                            case 3:
                                echo "el usuario es Analista de Inventario";
                                // no hace nada
                                break;
                                
                            default:
                                echo "Error Valor No reconocido";                            
                        }

                    }

                }else{
                    // Toquen invalido
                    
                    $resultado["codigoResultado"] = "0";
                    $resultado["mensaje"] = "Acceso Denegado, token invalido";
                    http_response_code(404);
                    echo json_encode($resultado);
                }            

            // Logueo 
/**************************************************************************************/
            }elseif(isset($_POST["correo"])){
                // Recibimos un Correo
                if (isset($_POST["password"])){

                    $usuario = new Usuario();
                    $usuario->set_Correo($_POST["correo"]);
                    $usuario->set_Password($_POST["password"]);
//echo "<---->1";
                    if ($usuario->consultarUsuario()){
                        http_response_code(200);
//echo "<---->2";
                        $resultado=array(
                            "token"=>$usuario->get_Token(),
                            "codigoResultado"=>"1",
                            "mensaje" => "Usuario autenticado",
                            "usuario" => array(
                                "nombre" => $usuario->get_Nombre(),
                                "correo" => $usuario->get_Correo(),
                                //echo ("tiempo: $fecha".date("d-m-Y h:i:s a", $fecha));
                                //"fecha_exp_lic" => $usuario->fecha_exp_lic,
                                "fecha_exp_lic" => date("d-m-Y h:i:s a", $usuario->fecha_exp_lic),
                                "nu_tipo_entidad_prf" => $usuario-> nu_tipo_entidad_prf,
                                "in_clasificacion_tipo_ent_prf" => $usuario-> in_clasificacion_tipo_ent_prf,
                                
                                "dni_enterprise" => $usuario-> dni_enterprise,
                                "nu_tipo_entidad_doc_ent" => $usuario->nu_tipo_entidad_doc_ent,
                                "in_clasificacion_tipo_ent_doc_ent" => $usuario-> in_clasificacion_tipo_ent_doc_ent

                                )
                            );                                

                        echo json_encode($resultado);

                    }else{
                        http_response_code(404);
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
            //echo "en put";
            
                                                                             
            // revisamos que tiene token
            if (isset($_GET["tkn"])) {
                $usuario = new Usuario();
                if ($usuario->consultarToken($_GET["tkn"])){                       
                    // aqui obtenemos el su rango
                    //echo ("nombre:".$usuario->get_Nombre()." nu_tipo_entidad_prf:".$usuario->nu_tipo_entidad_prf."\n");
                    
                    //if (isset($_GET["consulta"]) && ($_GET["consulta"]=="Insertar")){
                        
                        switch ($usuario->nu_tipo_entidad_prf) {
                            case 1:
                                //echo "el usuario es SuperAdmin \n";

                                    if (isset($_GET["nu_tipo_entidad_prf"])) { 

                                        if ($_GET["nu_tipo_entidad_prf"]==1||$_GET["nu_tipo_entidad_prf"]==2){
                                            // vamos a modificar tipo 1 o tipo 2
                                            // proceso 2
                                            //echo "entrando a modificarProceso2---\n";
                                            
                                            $fecha = strtotime($_GET["fecha"]);
                                            print ("fecha:$fecha \n");
                                            
                                            //filtrar los datos de entrada con get, no puede ser vacios
                                            if ($usuario->modificarProceso2( $_GET["email"],
                                                                             $_GET["nuevoNombre"],
                                                                             $_GET["nuevoApellido"],
    
                                                                             $_GET["nuevoUserName"],
                                                                             $_GET["nuevoPassword"],
                                                                             $_GET["nuevoEmail"], 
                                                                             $fecha,

                                                                             $_GET["nu_tipo_entidad_sta"],
                                                                             $_GET["in_clasificacion_tipo_ent_sta"],
                                                                             
                                                                             $_GET["nu_tipo_entidad_prf"],
                                                                             $_GET["in_clasificacion_tipo_ent_prf"],

                                                                             $_GET["dni"],
                                                                             $_GET["nu_tipo_entidad_doc"],
                                                                             $_GET["in_clasificacion_tipo_ent_doc"],
                                                                              
                                                                             $_GET["dni_enterprise"],
                                                                             $_GET["nu_tipo_entidad_doc_ent"],
                                                                             $_GET["in_clasificacion_tipo_ent_doc_ent"])){
                                                                         
                                                    http_response_code(200);
                                                    $resultado["codigoResultado"] = "1";
                                                    $resultado["mensaje"] = "Insercion realizada con exito";
                                                    
                                                    echo json_encode($resultado);
                                                }else{
                                                    http_response_code(404);
                                                    $resultado["codigoResultado"] = "0";
                                                    $resultado["mensaje"] = "Error en la Insercion";
                                                    
                                                    if ($usuario->nu_error)
                                                        $resultado["error"] = $usuario->str_error;   
                                                    
                                                    echo json_encode($resultado);
                                                }
                                        }
                                        
                                        if ($_GET["nu_tipo_entidad_prf"]==3){
                                            // vamos a insertar tipo 3
                                            // proceso 1
                                            // echo "entrando a proceso2---\n";
                                            if ($usuario->modificarProceso1( $_GET["email"],
                                            
                                                                         $_GET["nuevoNombre"],
                                                                         $_GET["nuevoApellido"],

                                                                         $_GET["nuevoUserName"],
                                                                         $_GET["nuevoPassword"],
                                                                         $_GET["nuevoEmail"],                       
                                                                         
                                                                         $_GET["nu_tipo_entidad_sta"],
                                                                         $_GET["in_clasificacion_tipo_ent_sta"],                                                                          
                                                                         
                                                                         $_GET["dni"],
                                                                         $_GET["nu_tipo_entidad_doc"],
                                                                         $_GET["in_clasificacion_tipo_ent_doc"],
                                                                         $_GET["nu_tipo_entidad_prf"],
                                                                         $_GET["in_clasificacion_tipo_ent_prf"],
                                                                         
                                                                         $_GET["nu_tipo_entidad_pry"],
                                                                         $_GET["in_clasificacion_tipo_ent_pry"],
                                                                          
                                                                         $_GET["dni_enterprise"],
                                                                         $_GET["nu_tipo_entidad_doc_ent"],
                                                                         $_GET["in_clasificacion_tipo_ent_doc_ent"])){
                                                               
                                                    http_response_code(200);
                                                    $resultado["codigoResultado"] = "1";
                                                    $resultado["mensaje"] = "Insercion realizada con exito";
                                                    
                                                    echo json_encode($resultado);
                                                }else{
                                                    http_response_code(404);
                                                    $resultado["codigoResultado"] = "0";
                                                    $resultado["mensaje"] = "Error en la Insercion";
                                                    
                                                    if ($usuario->nu_error)
                                                        $resultado["error"] = $usuario->str_error;

                                                    echo json_encode($resultado);
                                                }

                                        }

                                    }
                            break;
                                    
                        case 2:
                            //echo "el usuario es userAdmin \n";
                            
                            if (isset($_GET["nu_tipo_entidad_prf"])) { 
                                        if ($_GET["nu_tipo_entidad_prf"]==3){
                                            // vamos a insertar tipo 3
                                            // proceso 1
                                            //echo "entrando a modificarProceso1---\n";
                                            if ($usuario->modificarProceso1_2( $_GET["email"],
                                            
                                                                         $_GET["nuevoNombre"],
                                                                         $_GET["nuevoApellido"],

                                                                         $_GET["nuevoUserName"],
                                                                         $_GET["nuevoPassword"],
                                                                         $_GET["nuevoEmail"],  

                                                                         $_GET["nu_tipo_entidad_sta"],
                                                                         $_GET["in_clasificacion_tipo_ent_sta"],
                                                                          
                                                                         $_GET["dni"],
                                                                         $_GET["nu_tipo_entidad_doc"],
                                                                         $_GET["in_clasificacion_tipo_ent_doc"],
                                                                         
                                                                         $_GET["nu_tipo_entidad_pry"],
                                                                         $_GET["in_clasificacion_tipo_ent_pry"],
                                                                          
                                                                         $_GET["dni_enterprise"],
                                                                         $_GET["nu_tipo_entidad_doc_ent"],
                                                                         $_GET["in_clasificacion_tipo_ent_doc_ent"])){
                                                               
                                                    http_response_code(200);
                                                    $resultado["codigoResultado"] = "1";
                                                    $resultado["mensaje"] = "Insercion realizada con exito";
                                                    
                                                    echo json_encode($resultado);
                                                }else{
                                                    http_response_code(404);
                                                    $resultado["codigoResultado"] = "0";
                                                    $resultado["mensaje"] = "Error en la Insercion";
                                                    
                                                    if ($usuario->nu_error)
                                                        $resultado["error"] = $usuario->str_error;

                                                    echo json_encode($resultado);
                                                }

                                        }                            
                                
                            }
                            
                            break;
                        }
                        
                   // }
                }else{
                    // Toquen invalido
                    
                    $resultado["codigoResultado"] = "0";
                    $resultado["mensaje"] = "Acceso Denegado, token invalido";
                    http_response_code(404);
                    echo json_encode($resultado);
                }
                
            }

        break;

        case 'DELETE':
            /**************************************************************************************/

            // revisamos que tiene token
            if (isset($_GET["tkn"])) {
                $usuario = new Usuario();
                if ($usuario->consultarToken($_GET["tkn"])){    
                      
                    if ($usuario->eliminar($_GET["email"],

                            $_GET["dni"],
                            $_GET["nu_tipo_entidad_doc"],
                            $_GET["in_clasificacion_tipo_ent_doc"],

                            $_GET["dni_enterprise"],
                            $_GET["nu_tipo_entidad_doc_ent"],
                            $_GET["in_clasificacion_tipo_ent_doc_ent"])){

                            http_response_code(200);
                            $resultado["codigoResultado"] = "1";
                            $resultado["mensaje"] = "eliminacion realizada con exito";
                            
                            echo json_encode($resultado);
                        }else{
                            http_response_code(404);
                            $resultado["codigoResultado"] = "0";
                            $resultado["mensaje"] = "Error en la Eliminacion";
                            
                            if ($usuario->nu_error)
                                $resultado["error"] = $usuario->str_error;
    
                            echo json_encode($resultado);
                        }                                         
                }
            }
            
        break;
        default:
            echo "Error Metodo Request No aceptado";
    }

    /*

    // Armas el array
    $nombres = array(
    'nombre1' => $nombre1,
    // y así le sigues con los que faltan
    );
 
    // Si lo quieres como parte de $row, entonces
    $row = array_merge($row, $nombres);
 
    // Y después lo agregas a $items dentro del while
    array_push($items, $row);
    
    */
?>