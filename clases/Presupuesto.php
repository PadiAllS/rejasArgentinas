<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\clases;

/**
 * Description of Presupuesto
 *
 * @author norberto
 */
class Presupuesto {
    protected $nroPresupuesto; //integer
    protected $clienteId; //string
    protected $fechaPresupuesto; //string
    protected $arrayItem; //array ItemFactura

function __construct($nroPres, $idCliente, $fecha, $arrayItem)
 {
    $this->nroPresupuesto = $nroPres;
    $this->clienteId = $idCliente;
    $this->fechaPresupuesto = $fecha;
    $this->arrayItem = $arrayItem;
 }

public function getNroPresupuesto()
 {
    return $this->nroPresupuesto;
 }

public function setNroPresupuesto($valor)
 {
    if ($valor > 0){
        $this->nroPresupuesto = $valor;
             return true;
    } else {
        return false;
    }
 }

public function getClienteId()
 {
    return $this->clienteId;
 }

 public function setClienteId($valor)
 {
    $this->clienteId = $valor;
 }

    public function getFechaPresupuesto()
 {
    return $this->fechaPresupuesto;
 }

public function setFechaPresupuesto($fecha)
 {
    $this->fechaPresupuesto = $fecha;
 }


function agregarItem($producto)
 {
    $this->arrayItem[]= $producto;
 } 

public function mostrarItem()
 {
    return $this->arrayItem;
 }

public function cantidadItem()
 {
    $cantidadItem = count(getArrayItem());
    return $cantidadItem;
 }

public function obtenerPrecioTotal()
 {
    for($i=0; $i < count($this->arrayItem()); $i++){
        $precioTotal = $precioTotal + $this->arrayItem[$i]->obtenerPrecioParcial();
    }
        return$precioTotal;
 }
}