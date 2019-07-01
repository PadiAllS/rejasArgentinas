<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\clases;

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


function __construct($idProd, $categid, $codBarra, $nomprod, $stock, $descripcion, $imagen, $precio)
 {
    $this->idProducto = $codProd;
    $this->categoriaId = $categid;
    $this->codBarraProducto = $codBarra;
    $this->nombreProducto = $nomprod;
    $this->stockProducto = $stock;
    $this->descripcionProducto = $descripcion;
    $this->imagenProducto = $imagen;
    $this->precioProducto = $precio;

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
    return $this->nomProducto;
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

public function setPrecioProducto($valor)
 {
    $this->precioProducto = $valor;
 }

}


