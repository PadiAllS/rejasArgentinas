<?php
require_once '../clases/Config.php';
require_once '../clases/Presupuesto.php';
require_once '../clases/Producto.php';
require_once '../clases/Categoria.php';
require_once '../clases/Db.php';
require_once '../clases/ItemPresupuesto.php';

use app\clases\Db;
use app\clases\Presupuesto;
use app\clases\Producto;
use app\clases\Categoria;
use app\clases\ItemPresupuesto;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

$mensaje= "";

if (isset($_POST['btnAccion']))
{
    switch ($_POST['btnAccion'])
    {
        case 'agregar':
            if(is_numeric(openssl_decrypt($_POST['idProd'], COD, KEY)))
            {
                $idProducto= openssl_decrypt($_POST['idProd'], COD, KEY);
                $mensaje= "Ok, ID Correcto".$idProducto."<br>";
            } else {
                $mensaje= "el ID no es valido "."<br>";
            }
            if(is_string(openssl_decrypt($_POST['nombProd'], COD, KEY)))
            {
                $nombProducto= openssl_decrypt($_POST['nombProd'], COD, KEY);
                $mensaje= "Ok, Nombre Correcto".$nombProducto."<br>";
            } else {
                $mensaje= "el Nombre no es valido "."<br>";
            }
            
            if(is_numeric(openssl_decrypt($_POST['precM2Prod'], COD, KEY)))
            {
                $precM2Producto= openssl_decrypt($_POST['precM2Prod'], COD, KEY);
                $mensaje= "Ok, Precio x metro cuadrado Correcto".$precM2Producto."<br>";
            } else {
                $mensaje= "el Precio x metro cuadrado no es valido "."<br>";
            }
            
            if(is_numeric($_POST['altoProd']))
            {
                $altoProducto= $_POST['altoProd'];
                $mensaje= "Ok, alto es  Correcto".$altoProducto."<br>";
            } else {
                $mensaje= "el alto no es valido "."<br>";
            }
            
            if(is_numeric($_POST['anchoProd']))
            {
                $anchoProducto= $_POST['anchoProd'];
                $mensaje= "Ok, ancho es Correcto".$anchoProducto."<br>";
            } else {
                $mensaje= "el ancho no es valido "."<br>";
            }
            
            if(is_numeric($_POST['cantProd']))
            {
                $cantProducto= $_POST['cantProd'];
                $mensaje= "Ok, cantidad es Correcta".$cantProducto."<br>";
            } else {
                $mensaje= "la cantidad no es valida "."<br>";
            }
            
            if(!isset($_SESSION['presupuesto']))
            {
                $productoArray = array(
                    'id' => intval($idProducto), 
                    'nombre'=> $nombProducto,
                    'precioM2'=> intval($precM2Producto),
                    'alto'=> intval($altoProducto), 
                    'ancho'=> intval($anchoProducto), 
                    'cantidad'=> intval($cantProducto));
                    
                $_SESSION['presupuesto'][0] = $productoArray;
            } else {
                $nroProductos= count($_SESSION['presupuesto']);
                $productoArray = array('id' =>$idProducto, 'nombre'=> $nombProducto, 'precioM2'=> $precM2Producto,'alto'=> $altoProducto, 'ancho'=> $anchoProducto, 'cantidad'=> $cantProducto);
                $_SESSION['presupuesto'][$nroProductos] = $productoArray;
                
            }
            
        break;
        
        case 'borrar':
            if(is_numeric(openssl_decrypt($_POST['idProd'], COD, KEY)))
                {
                    $idProducto= intval(openssl_decrypt($_POST['idProd'], COD, KEY));
                    foreach ($_SESSION['presupuesto'] as $key => $prodPresu) {
                        if($prodPresu['id']==$idProducto)
                        {
                            unset($_SESSION['presupuesto'][$key]);
                            echo "<script>alert(Producto eliminado!)</script>";
                        }

                    }
                    ;
                } else {
                    $mensaje= "el ID no es valido "."<br>";
                }
        break;        
           
        case 'enviar':
          if(isset($_POST['btnAccion']))
            {
                try 
                {
                    $_POST['usuarioId']= $_SESSION['usuarioId'];
                    $_POST['fechaPresupuesto']= date_create();
                    //$_POST['montoPresupuesto']= "pendiente";
                    $_POST['statusPresupuesto']= "pendiente";
                    
                    $conn = Db::getConexion();
                    $conn->beginTransaction();
                    
                    $presupuesto1 = Presupuesto::crearDesdeParametros($_POST);
                    $presupuesto1->insertar();

                    $presupuestoId= $presupuesto1->getIdPresupuesto();
                    foreach ($_SESSION['presupuesto'] as $prodPresu) 
                    {
                        $superficie=  (($prodPresu['alto']*$prodPresu['ancho'])/10000);   
                        $precio= ($superficie*$prodPresu['cantidad']*$prodPresu['precioM2']);
                        $itemprod['presupuestoId']=$presupuestoId;
                        $itemprod['productoId']= $prodPresu['id'];
                        $itemprod['altoPresu']= $prodPresu['alto'];
                        $itemprod['anchoPresu']= $prodPresu['ancho'];
                        $itemprod['precioPresu']= $precio;
                        $itemprod['cantidadPresu']= $prodPresu['cantidad'];
                        
                        $itemPresupuesto1= ItemPresupuesto::crearDesdeParametros($itemprod);
                        $itemPresupuesto1->insertar();
                        
                    }
                    
                    $conn->commit();
                    
                    
                    
                }catch(TypeError $e){
                    $conn->rollBack();
                    $mensaje = 'Error al obtener la información de la base de datos';


                    }catch(Throwable $e){
                    error_log($e->getMessage());
                    $mensaje = 'Error inesperado, consulte con su administrador';
                }
                unset($_SESSION['presupuesto']);
                header('Location:../paginas/presupuesto.php');
                exit();
                
            }else{
                $mensaje = 'No se recibió la información necesaria para crear un producto';
            }
            
        break;
    }
        
        header('Location:../paginas/presupuesto.php');
        exit();
        
}
