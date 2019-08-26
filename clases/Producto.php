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
class Producto {
    protected $idProducto; //int
    protected $categoriaId; //int
    protected $codBarraProducto; //string
    protected $nombreProducto; //string
    protected $stockProducto; //int
    protected $descripcionProducto; //string
    protected $imagenProducto; //string
    protected $precioProducto; //float
    protected $precioM2Producto; //float


function __construct($categid, $codBarra, $nomprod, $stock, $descripcion, $imagen, $precio, $precioM2, $idProd=null)
 {
    $this->idProducto = $idProd;
    $this->categoriaId = $categid;
    $this->codBarraProducto = $codBarra;
    $this->nombreProducto = $nomprod;
    $this->stockProducto = $stock;
    $this->descripcionProducto = $descripcion;
    $this->imagenProducto = $imagen;
    $this->precioProducto = $precio;
    $this->precioM2Producto = $precioM2;

 }


public function getIdProducto()
 {
    return $this->idProducto;
 }

public function getCategoriaId()
 {
    return $this->categoriaId;
 }

public function getCodBarraProducto()
 {
    return $this->codBarraProducto;
 }

public function getNomProducto()
 {
    return $this->nombreProducto;
 }

public function setNombreProducto($valor)
 {
    $this->nombreProducto = $valor;
 }

 public function getStockProducto()
 {
    return $this->stockProducto;
 }
 
 public function getDescripcionProducto()
 {
    return $this->descripcionProducto;
 }
 
 public function getImagenProducto()
 {
    return $this->imagenProducto;
 }
 
public function getPrecioProducto()
 {
    return $this->precioProducto;
 }
public function getPrecioM2Producto()
 {
    return $this->precioM2Producto;
 }

public function setPrecioProducto($valor)
 {
    $this->precioProducto = $valor;
 }

    public function insertar(): bool {
    //    if (!$this->esProductoValido()) {
    //        return false;
    //    }
        $sql = 'INSERT INTO producto(categoriaId, codBarraProducto, nombreProducto, stockProducto, descripcionProducto, imagenProducto, precioProducto, precioM2Producto) '
                . 'VALUES (:categoria, :codBarra, :nombre, :stock, :descripcion, :imagen, :precio, :precioM2)';

        $conn = Db::getConexion(); 
        $pst = $conn->prepare($sql); 
        $pst->bindValue(':categoria', $this->categoriaId);
        $pst->bindValue(':codBarra', $this->codBarraProducto);
        $pst->bindValue(':nombre', $this->nombreProducto);
        $pst->bindValue(':stock', $this->stockProducto);
        $pst->bindValue(':descripcion', $this->descripcionProducto);
        $pst->bindValue(':imagen', $this->imagenProducto);
        $pst->bindValue(':precio', $this->precioProducto);
        $pst->bindValue(':precioM2', $this->precioM2Producto);
        
        $pst->execute(); 
        if ($pst->rowCount() === 1) { 
            $this->setId($conn->lastInsertId()); 
            return true;
        } else {
            return false;
        }
        
    }
    public function actualizar(): bool {
    //    if (!$this->esProductoValido()) {
    //        return false;
    //    }
        $sql= 'UPDATE producto SET =:categoria,codBarraProducto=codBarra,nombreProducto=:nombre, stockProducto=:stock, descripcionProducto=:descripcion, imagenProducto=:imagene, precioProducto=:precio, precioM2Producto=:precioM2 WHERE idProducto = :idProducto';
    
        
//        $sql = 'INSERT INTO producto(categoriaId, codBarraProducto, nombreProducto, stockProducto, descripcionProducto, imagenProducto, precioProducto, precioM2Producto) '
//                . 'VALUES (:categoria, :codBarra, :nombre, :stock, :descripcion, :imagen, :precio, :precioM2)';

        $conn = Db::getConexion(); 
        $pst = $conn->prepare($sql); 
        $pst->bindValue(':categoria', $this->categoriaId);
        $pst->bindValue(':codBarra', $this->codBarraProducto);
        $pst->bindValue(':nombre', $this->nombreProducto);
        $pst->bindValue(':stock', $this->stockProducto);
        $pst->bindValue(':descripcion', $this->descripcionProducto);
        $pst->bindValue(':imagen', $this->imagenProducto);
        $pst->bindValue(':precio', $this->precioProducto);
        $pst->bindValue(':precioM2', $this->precioM2Producto);
        
        $pst->execute(); 
        if ($pst->rowCount() === 1) { 
            $this->setId($conn->lastInsertId()); 
            return true;
        } else {
            return false;
        }
        
    }
    
    public function eliminar(): bool 
    {
        $sql='delete from producto where idProducto = :id';
        $conn= Db::getConexion();
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $this->idProducto);
        $productoArray = $stmt->execute();
        if ($productoArray === FALSE) {
            throw new NullObjectError('Objeto inexistente');
        }
        return true;
    }
    
    public static function buscarPorId(int $id): self
    {
        $conexion = Db::getConexion();
        $stmt = $conexion->prepare('select * from producto where idProducto = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $productoArray = $stmt->fetch();
        if($productoArray===FALSE){
            throw new NullObjectError('Objeto inexistente');
        }
        
        return new Producto($productoArray['idProducto'], $productoArray['categriaId'], $productoArray['codBarraProducto'],$productoArray['nombreProducto'], $productoArray['stockProducto'], $productoArray['descripcionProducto'], $productoArray['imagenProducto'], $productoArray['precioProducto']);
        
    }
    
    

    public function esProductoValido(): bool {
        
        if (strlen($this->nombreProducto) < 4)     
        {
            $this->errores[] = 'El nombre debe tener mas de 3 caracteres';
        }
        if (strlen($this->descripcionProducto) < 11)            
        {
            $this->errores[] = 'La Descripcion debe tener mas de 10 caracteres';
        }
        
        return count($this->errores) === 0;
    }

    public static function buscarCriteros(string $nombre = '', $descripcion = '', $categoria = ''): array {
        $sql = "
            select * from `producto` 
                where
                ( (nombreProducto like :nombre) OR (:nombretest = '') ) AND
                ( (descripcionProducto like :descripcion) OR (:descripciontest = '') ) AND
                ( (categoriaId like :categoria) OR (:categoriatest = '') )
                ";

        $conn = Db::getConexion(); 
        $pst = $conn->prepare($sql); 
         $pst->bindValue(':nombre', '%'.$nombre.'%');
        $pst->bindValue(':nombretest', $nombre);
        $pst->bindValue(':descripcion', '%'.$descripcion.'%');
        $pst->bindValue(':descripciontest', $descripcion);
        $pst->bindValue(':categoria', '%'.$categoria.'%');
        $pst->bindValue(':categoriatest', $categoria);
        $pst->execute(); 
        $resultado = $pst->fetchAll(); 
        $listaProductos = self::listaArreglosAListaProductos($resultado); 
        return $listaProductos; 
    }

    private static function listaArreglosAListaProductos(array $listaArreglo): array {
        $resultado = [];
        foreach ($listaArreglo as $nuevoProducto) {
            $resultado[] = Producto::crearDesdeParametros($nuevoProducto);
        }
        return $resultado;
    }

    public static function busquedaRapida(string $criterioRapido = ''): array {
        if (!$criterioRapido) {
            return self::buscarCriteros();
        } else {
            $sql = "
                select * from `producto` 
                    where
                    (nombreProducto like :nombre) OR
                    (descripcionProducto like :descripcion)";
                  //  (categoriaId like ':categoria')";

            $conn = Db::getConexion(); 
            $pst = $conn->prepare($sql);
            $pst->bindValue(':nombre', '%'.$criterioRapido.'%'); 
            $pst->bindValue(':descripcion', '%'.$criterioRapido.'%');
            //$pst->bindValue(':categoria', '%'.$criterioRapido.'%');
            $pst->execute(); 
            $resultado = $pst->fetchAll(); 
            $listaProductos = self::listaArreglosAListaProductos($resultado); 
            return $listaProductos; 
        }
    }
    
    public static function crearDesdeParametros(array $parametros): self {
        $id = !empty(intval($parametros['idProducto'])) ? intval($parametros['idProducto']) : null;
        $categoriaId = intval($parametros['categoriaId']) ?? null;
        $codBarraProducto = $parametros['codBarraProducto'] ?? null;
        $nombreProducto = $parametros['nombreProducto'] ?? null;
        $stockProducto = intval($parametros['stockProducto']) ?? null;
        $descripcionProducto = $parametros['descripcionProducto'] ?? null;
        $imagenProducto = $parametros['imagenProducto'] ?? null;
        $precioProducto = floatval($parametros['precioProducto']) ?? null;
        $precioM2Producto = floatval($parametros['precioM2Producto']) ?? null;
        $producto = new Producto($categoriaId, $codBarraProducto, $nombreProducto, $stockProducto, $descripcionProducto, $imagenProducto, $precioProducto, $precioM2Producto, $id);
        return $producto;
    }

    



    }
