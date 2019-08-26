<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


declare(strict_types=1);
namespace app\clases;
require_once 'Db.php';

use app\clases\Db;
/**
 * Description of Producto
 *
 * @author norberto
 */
class ItemPresupuesto {
    protected $idItemPresu; //int
    protected $presupuestoId; //int
    protected $productoId; //string
    protected $altoPresu; //int
    protected $anchoPresu; //string
    protected $precioPresu; //string
    protected $cantidadPresu; //float
    

function __construct($presupuestoId, $productoId, $alto, $ancho, $precio, $cantidad, $idItemPresu=null)
 {
    $this->idItemPresu = $idItemPresu;
    $this->presupuestoId = $presupuestoId;
    $this->productoId = $productoId;
    $this->altoPresu = $alto;
    $this->anchoPresu = $ancho;
    $this->precioPresu = $precio;
    $this->cantidadPresu = $cantidad;
    
 }


public function getIdItemPresu()
 {
    return $this->idItemPresu;
 }

public function getPresupuestoId()
 {
    return $this->presupuestoId;
 }

public function getProductoId()
 {
    return $this->productoId;
 }

public function getAltoPresu()
 {
    return $this->altoPresu;
 }

 public function getAnchoPresu()
 {
    return $this->anchoPresu;
 }
 
 public function getPrecioPresu()
 {
    return $this->precioPresu;
 }
 
 public function getCantidadPresu()
 {
    return $this->cantidadPresu;
 }
 
public function setIdItemPresu($valor)
 {
    $this->idItemPresu = $valor;
 }

    public function insertar(): bool {
    //    if (!$this->esProductoValido()) {
    //        return false;
    //    }
        $sql = 'INSERT INTO itemPresupuesto(presupuestoId, productoId, altopresu, anchoPresu, precioPresu, cantidadPresu)'
                . 'VALUES (:presupuestoId, :productoId, :alto, :ancho, :precio, :cantidad)';

        $conn = Db::getConexion(); 
        $pst = $conn->prepare($sql); 
        $pst->bindValue(':presupuestoId', $this->presupuestoId);
        $pst->bindValue(':productoId', $this->productoId);
        $pst->bindValue(':alto', $this->altoPresu);
        $pst->bindValue(':ancho', $this->anchoPresu);
        $pst->bindValue(':precio', $this->precioPresu);
        $pst->bindValue(':cantidad', $this->cantidadPresu);
        
        $pst->execute(); 
        if ($pst->rowCount() === 1) { 
            $this->setIdItemPresu($conn->lastInsertId()); 
            return true;
        } else {
            return false;
        }
        
    }
//    public function actualizar(): bool {
//    
//        $sql= 'UPDATE producto SET =:presupuestoId,pro=codBarra,nombreProducto=:nombre, stockProducto=:stock, descripcionProducto=:descripcion, imagenProducto=:imagene, precioProducto=:precio, precioM2Producto=:precioM2 WHERE idProducto = :idProducto';
//    
//        
//
//        $conn = Db::getConexion(); 
//        $pst = $conn->prepare($sql); 
//        $pst->bindValue(':categoria', $this->categoriaId);
//        $pst->bindValue(':codBarra', $this->codBarraProducto);
//        $pst->bindValue(':nombre', $this->nombreProducto);
//        $pst->bindValue(':stock', $this->stockProducto);
//        $pst->bindValue(':descripcion', $this->descripcionProducto);
//        $pst->bindValue(':imagen', $this->imagenProducto);
//        $pst->bindValue(':precio', $this->precioProducto);
//        $pst->bindValue(':precioM2', $this->precioM2Producto);
//        
//        $pst->execute(); 
//        if ($pst->rowCount() === 1) { 
//            $this->setId($conn->lastInsertId()); 
//            return true;
//        } else {
//            return false;
//        }
//        
//    }
    
    public function eliminar(): bool 
    {
        $sql='delete from itemPresupuesto where idItemPresu = :id';
        $conn= Db::getConexion();
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $this->idItemPresu);
        $itemArray = $stmt->execute();
        if ($itemArray === FALSE) {
            throw new NullObjectError('Objeto inexistente');
        }
        return true;
    }
    
    public static function buscarPorId(int $id): self
    {
        $conexion = Db::getConexion();
        $stmt = $conexion->prepare('select * from itemPresupuesto where idItemPresu = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $itemArray = $stmt->fetch();
        if($itemArray===FALSE){
            throw new NullObjectError('Objeto inexistente');
        }
        
        return new Producto($itemArray['idItemPresu'], $itemArray['presupuestoId'], $itemArray['productoId'],$itemArray['altoPresu'], $itemArray['anchoPresu'], $itemArray['precioPresu'], $itemArray['cantidadPresu']);
        
    }
    
    

//    public function esProductoValido(): bool {
//        
//        if (strlen($this->nombreProducto) < 4)     
//        {
//            $this->errores[] = 'El nombre debe tener mas de 3 caracteres';
//        }
//        if (strlen($this->descripcionProducto) < 11)            
//        {
//            $this->errores[] = 'La Descripcion debe tener mas de 10 caracteres';
//        }
//        
//        return count($this->errores) === 0;
//    }

//    public static function buscarCriteros(string $nombre = '', $descripcion = '', $categoria = ''): array {
//        $sql = "
//            select * from `producto` 
//                where
//                ( (nombreProducto like :nombre) OR (:nombretest = '') ) AND
//                ( (descripcionProducto like :descripcion) OR (:descripciontest = '') ) AND
//                ( (categoriaId like :categoria) OR (:categoriatest = '') )
//                ";
//
//        $conn = Db::getConexion(); 
//        $pst = $conn->prepare($sql); 
//         $pst->bindValue(':nombre', '%'.$nombre.'%');
//        $pst->bindValue(':nombretest', $nombre);
//        $pst->bindValue(':descripcion', '%'.$descripcion.'%');
//        $pst->bindValue(':descripciontest', $descripcion);
//        $pst->bindValue(':categoria', '%'.$categoria.'%');
//        $pst->bindValue(':categoriatest', $categoria);
//        $pst->execute(); 
//        $resultado = $pst->fetchAll(); 
//        $listaProductos = self::listaArreglosAListaProductos($resultado); 
//        return $listaProductos; 
//    }
    
    
    public static function buscarPresupuesto(string $presupuestoId = ''): array {
        $sql = "
            select * from `itemPresupuesto` 
                where
                ( (presupuestoId like :presupuesto) OR (:presupuestotest = '') )
                ";

        $conn = Db::getConexion(); 
        $pst = $conn->prepare($sql); 
         $pst->bindValue(':presupuestoId', '%'.$presupuestoId.'%');
        $pst->bindValue(':presupuestotest', $presupuestoId);
        $pst->execute(); 
        $resultado = $pst->fetchAll(); 
        $listaItem = self::listaArreglosAListaProductos($resultado); 
        return $listaItem; 
    }

    private static function listaArreglosAListaItem(array $listaArreglo): array {
        $resultado = [];
        foreach ($listaArreglo as $nuevoItem) {
            $resultado[] = Producto::crearDesdeParametros($nuevoItem);
        }
        return $resultado;
    }

//    public static function busquedaRapida(string $criterioRapido = ''): array {
//        if (!$criterioRapido) {
//            return self::buscarCriteros();
//        } else {
//            $sql = "
//                select * from `producto` 
//                    where
//                    (nombreProducto like :nombre) OR
//                    (descripcionProducto like :descripcion)";
//                  //  (categoriaId like ':categoria')";
//
//            $conn = Db::getConexion(); 
//            $pst = $conn->prepare($sql);
//            $pst->bindValue(':nombre', '%'.$criterioRapido.'%'); 
//            $pst->bindValue(':descripcion', '%'.$criterioRapido.'%');
//            //$pst->bindValue(':categoria', '%'.$criterioRapido.'%');
//            $pst->execute(); 
//            $resultado = $pst->fetchAll(); 
//            $listaProductos = self::listaArreglosAListaProductos($resultado); 
//            return $listaProductos; 
//        }
//    }
    
    public static function crearDesdeParametros(array $parametros): self {
        $id = !empty(intval($parametros['idItemPresu'])) ? intval($parametros['idItemPresu']) : null;
        $presupuestoId = intval($parametros['presupuestoId']) ?? null;
        $productoId = $parametros['productoId'] ?? null;
        $altoPresu = $parametros['altoPresu'] ?? null;
        $anchoPresu = $parametros['anchoPresu'] ?? null;
        $precioPresu = $parametros['precioPresu'] ?? null;
        $cantidadPresu = $parametros['cantidadPresu'] ?? null;
        $itemPresu = new ItemPresupuesto($presupuestoId, $productoId, $altoPresu, $anchoPresu, $precioPresu, $cantidadPresu, $id);
        return $itemPresu;
    }

    



    }
