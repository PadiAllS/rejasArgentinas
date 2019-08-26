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
class Presupuesto {
    protected $idPresupuesto; //int
    protected $usuarioId; //int
    protected $fechaPresupuesto; //date
    protected $montoPresupuesto; //decimal
    protected $statusPresupuesto; //string


function __construct($usuarioId, $fechaPresupuesto, $montoPresupuesto, $statusPresupuesto, $idPresupuesto=null)
 {
    $this->usuarioId = $usuarioId;
    $this->fechaPresupuesto = $fechaPresupuesto;
    $this->montoPresupuesto = $montoPresupuesto;
    $this->statusPresupuesto = $statusPresupuesto;
    $this->idPresupuesto = $idPresupuesto;
    
 }


public function getIdPresupuesto()
 {
    return $this->idPresupuesto;
 }

public function getUsuarioId()
 {
    return $this->usuarioId;

 }

public function getFechaPresupuesto()
 {
    return $this->fechaPresupuesto;
 }

public function getStatusPresupuesto()
 {
    return $this->statusPresupuesto;
 }

 public function getMontoPresupuesto()
 {
    return $this->montoPresupuesto;
 }
 
public function setIdPresupuesto($valor)
 {
    $this->idPresupuesto = $valor;
 }

    public function insertar(): bool {
    //    if (!$this->esProductoValido()) {
    //        return false;
    //    }
        //$this->fechaPresupuesto = now();
        $sql = 'INSERT INTO presupuesto(usuarioId, fechaPresupuesto, montoPresupuesto, statusPresupuesto) '
                . 'VALUES (:usuario, NOW(), :monto, :status)';

        $conn = Db::getConexion(); 
        $pst = $conn->prepare($sql); 
        $pst->bindValue(':usuario', $this->usuarioId);
        //$pst->bindValue(':fecha', $this->fechaPresupuesto);
        $pst->bindValue(':monto', $this->montoPresupuesto);
        $pst->bindValue(':status', $this->statusPresupuesto);
        
        $pst->execute(); 
        if ($pst->rowCount() === 1) { 
            $this->setIdPresupuesto($conn->lastInsertId()); 
            return true;
        } else {
            return false;
        }
        
    }
//    public function actualizar(): bool 
//    //    if (!$this->esProductoValido()) {
//    //        return false;
//    //    }
//     //   $sql= 'UPDATE presupuesto SET =:usuario, fechaPresupuesto=fecha, montoPresupuesto=:monto, statusPresupuesto=:status WHERE idPresupuesto = :idPresupuesto';
//    
//        
////        $sql = 'INSERT INTO producto(categoriaId, codBarraProducto, nombreProducto, stockProducto, descripcionProducto, imagenProducto, precioProducto, precioM2Producto) '
////                . 'VALUES (:categoria, :codBarra, :nombre, :stock, :descripcion, :imagen, :precio, :precioM2)';
//
//        $conn = Db::getConexion(); 
//        $pst = $conn->prepare($sql); 
//        $pst->bindValue(':usuario', $this->usuarioId);
//        $pst->bindValue(':fecha', $this->fechaPresupuesto);
//        $pst->bindValue(':monto', $this->montoPresupuesto);
//        $pst->bindValue(':status', $this->statusPresupuesto);
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
        $sql='delete from presupuesto where idPresupuesto = :id';
        $conn= Db::getConexion();
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $this->idPresupuesto);
        $productoArray = $stmt->execute();
        if ($productoArray === FALSE) {
            throw new NullObjectError('Objeto inexistente');
        }
        return true;
    }
    
    public static function buscarPorId(int $id): self
    {
        $conexion = Db::getConexion();
        $stmt = $conexion->prepare('select * from presupuesto where idPresupuesto = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $presupuestoArray = $stmt->fetch();
        if($presupuestoArray===FALSE){
            throw new NullObjectError('Objeto inexistente');
        }
        
        return new Presupuesto($presupuestoArray['idPresupuesto'], $presupuestoArray['usuarioId'], $presupuestoArray['fechaPresupuesto'],$presupuestoArray['montoPresupuesto'], $presupuestoArray['statusPresupuesto']);
        
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

    public static function buscarCriteros(string $fecha = '', $usuario = ''): array {
        $sql = "
            select * from `presupuesto` 
                where
                ( (fechaPresupuesto like :fecha) OR (:fechatest = '') ) AND
                ( (usuarioId like :usuario) OR (:usuariotest = '') )
                ";

        $conn = Db::getConexion(); 
        $pst = $conn->prepare($sql); 
         $pst->bindValue(':fecha', '%'.$fecha.'%');
        $pst->bindValue(':fechatest', $fecha);
        $pst->bindValue(':usuario', '%'.$usuario.'%');
        $pst->bindValue(':usuariotest', $usuario);
        $pst->execute(); 
        $resultado = $pst->fetchAll(); 
        $listaPresupuesto = self::listaArreglosAListaPresupuesto($resultado); 
        return $listaPresupuesto; 
    }

    private static function listaArreglosAListaPresupuestos(array $listaArreglo): array {
        $resultado = [];
        foreach ($listaArreglo as $nuevoPresupuesto) {
            $resultado[] = Presupuesto::crearDesdeParametros($nuevoPresupuesto);
        }
        return $resultado;
    }

    public static function busquedaRapida(string $criterioRapido = ''): array {
        if (!$criterioRapido) {
            return self::buscarCriteros();
        } else {
            $sql = "
                select * from `presupuesto` 
                    where
                    (fechaPresupuesto like :fecha) OR
                    (usuarioId like :usuario)";
                  //  (categoriaId like ':categoria')";

            $conn = Db::getConexion(); 
            $pst = $conn->prepare($sql);
            $pst->bindValue(':fecha', '%'.$criterioRapido.'%'); 
            $pst->bindValue(':usuario', '%'.$criterioRapido.'%');
            //$pst->bindValue(':categoria', '%'.$criterioRapido.'%');
            $pst->execute(); 
            $resultado = $pst->fetchAll(); 
            $listaPresupuestos = self::listaArreglosAListaPresupuestos($resultado); 
            return $listaPresupuestos; 
        }
    }
    
    public static function crearDesdeParametros(array $parametros): self {
        $id = !empty(intval($parametros['idPresupuesto'])) ? intval($parametros['idPresupuesto']) : null;
        $usuarioId = intval($parametros['usuarioId']) ?? null;
        $fechaPresupuesto = $parametros['fechaPresupuesto'] ?? null;
        $montoPresupuesto = floatval($parametros['montoPresupuesto']) ?? null;
        $statusPresupuesto = $parametros['statusPresupuesto'] ?? null;
        $presupuesto = new Presupuesto($usuarioId, $fechaPresupuesto, $montoPresupuesto, $statusPresupuesto, $id);
        return $presupuesto;
    }

    



    }
