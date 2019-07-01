<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\clases;

/**
 * Description of ItemPresupuesto
 *
 * @author norberto
 */
class ItemPresupuesto {

    protected $numItem; //integer
    protected $prodItem; //producto  
    protected $cantidadProducto; //float


function __construct($numItem, $prodItem, $cantProd)

 {

    $this->numItem = $numItem;
    $this->prodItem = $prodItem;
    $this->cantidadProducto = $cantProd;

 }


public function getNumItem()
 {
    return$this->numItem;
 }

public function setNumItem($valor)
 {
    $this->numItem = $valor;
 }

public function getProdItem()
 {
    return$this->prodItem;
 }

public function setProdItem($valor)
 {
     $this->prodItem = $valor;
 }

public function getCantidadProducto()
 {
    return$this->cantidadProducto;
 }

    public function setCantidadProducto($valor)
 {
    $this->cantidadProducto = $valor;
 }

public function obtenerPrecioParcial()
 {
    $precioParcialItem = $this->cantidadProducto * $this->prodItem->getPrecioUnit();
    return$precioParcialItem; 
 }

}


