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

class Categoria 
{
    protected $idCategoria;
    protected $nombreCategoria;
    protected $descripcionCategoria;
    protected $condicionCategoria;
    protected $errores = [];



    public function __construct(string $nombre, string $descripcion,  $condicion, int $id = null) 
    {
        $this->nombreCategoria = $nombre;
        $this->descripcionCategoria = $descripcion;
        $this->condicionCategoria = $condicion;
        $this->idCategoria = $id;
        
    }

    // -------------------- Getters ----------------------
    public function getIdCategoria(): int {
        return $this->idCategoria;
    }

    public function getDescripcionCategoria(): string {
        return $this->descripcionCategoria;
    }
    public function getCondicionCategoria(): string {
        return $this->condicionCategoria;
    }

    public function getNombreCategoria(): string {
        return $this->nombreCategoria;
    }


    // --------------------- ----------------------


    public function setIdCategoria($valor) {
        $this->id = intval($valor);
    }

    public function insertar(): bool {
        if (!$this->esCategoriaValida()) {
            return false;
        }
        $sql = 'INSERT INTO categoria (nombreCategoria, descripcionCategoria) values (:nombre, :descripcion)';

        $conn = Db::getConexion(); 
        $pst = $conn->prepare($sql); 
        $pst->bindValue(':nombre', $this->nombreCategoria);
        $pst->bindValue(':descripcion', $this->descripcionCategoria);
        $pst->execute(); 
        if ($pst->rowCount() === 1) { 
            $this->setIdCategoria($conn->lastInsertId()); 
            return true;
        } else {
            return false;
        }
        
    }
    
    public function actualizar(): bool {
        if (!$this->esCategoriaValida()) {
            return false;
        }
        $sql = 'UPDATE categoria SET nombreCategoria=:nombre, descripcionCategoria=:descripcion WHERE idCategoria= :idCategoria';

        $conn = Db::getConexion(); 
        $pst = $conn->prepare($sql); 
        $pst->bindValue(':nombre', $this->nombreCategoria);
        $pst->bindValue(':descripcion', $this->descripcionCategoria);
        $pst->bindValue(':idCategoria', $this->idCategoria);
        $pst->execute(); 
        if ($pst->rowCount() === 1) { 
            return true;
        } else {
            return false;
        }
        
    }
    
    public function activar(): bool {
        
        $sql = 'UPDATE categoria SET condicionCategoria=1 WHERE idCategoira= :idCategoria';

        $conn = Db::getConexion(); 
        $pst = $conn->prepare($sql); 
        $pst->bindValue(':idCategoria', $this->idCategoria);
        //$pst->bindValue(':condicion', $this->condicionCategoria);
        $pst->execute(); 
        if ($pst->rowCount() === 1) { 
            return true;
        } else {
            return false;
        }
        
    }
    
    public function desactivar(): bool {
        
        $sql = 'UPDATE categoria SET condicionCategoria=0 WHERE idCategoira= :idCategoria';

        $conn = Db::getConexion(); 
        $pst = $conn->prepare($sql); 
        $pst->bindValue(':idCategoria', $this->idCategoria);
        //$pst->bindValue(':condicion', $this->condicionCategoria);
        $pst->execute(); 
        if ($pst->rowCount() === 1) { 
            return true;
        } else {
            return false;
        }
        
    }
    
    public function eliminar(): bool 
    {
        $sql='delete from categoria where idCategoria = :id';
        $conn= Db::getConexion();
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $this->idCategoria);
        $categoriaArray = $stmt->execute();
        if ($categoriaArray === FALSE) {
            throw new NullObjectError('Objeto inexistente');
        }
        return true;
    }
    
    public static function buscarPorId(int $id): self
    {
        $conexion = Db::getConexion();
        $stmt = $conexion->prepare('select * from categoria where idCategoria = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $categoriaArray = $stmt->fetch();
        if($categoriaArray===FALSE){
            throw new NullObjectError('Objeto inexistente');
        }
        
        return new Categoria($categoriaArray['nombreCategoria'], $categoriaArray['descripcionCategoria'], $categoriaArray['condicionCategoria'], $categoriaArray['idCategoria']);
        
    }
    
    

    public function esCategoriaValida(): bool {
        
        if (strlen($this->nombreCategoria) < 4)     
        {
            $this->errores[] = 'El nombre debe tener mas de 3 caracteres';
        }
        if (strlen($this->descripcionCategoria) < 11)            
        {
            $this->errores[] = 'La descripcion debe tener mas de 10 caracteres';
        }
        
        return count($this->errores) === 0;
    }

    public static function buscarCriteros(string $nombre = '', $descripcion = '', $condicion = ''): array {
        $sql = "
            select * from `categoria` 
                where
                ( (nombreCategoria like :nombre) OR (:nombretest = '') ) AND
                ( (descripcionCategoria like :descripcion) OR (:descripciontest = '') ) AND
                ( (condicionCategoria like :condicion) OR (:condiciontest = '') )
                ";

        $conn = Db::getConexion(); 
        $pst = $conn->prepare($sql); 
         $pst->bindValue(':nombre', '%'.$nombre.'%');
        $pst->bindValue(':nombretest', $nombre);
        $pst->bindValue(':descripcion', '%'.$descripcion.'%');
        $pst->bindValue(':descripciontest', $descripcion);
        $pst->bindValue(':condicion', '%'.$condicion.'%');
        $pst->bindValue(':condiciontest', $condicion);
        $pst->execute(); 
        $resultado = $pst->fetchAll(); 
        $listaCategorias = self::listaArreglosAListaCategorias($resultado); 
        return $listaCategorias; 
    }

    private static function listaArreglosAListaCategorias(array $listaArreglo): array {
        $resultado = [];
        foreach ($listaArreglo as $nuevaCategoria) {
            $resultado[] = Categoria::crearDesdeParametros($nuevaCategoria);
        }
        return $resultado;
    }

    public static function busquedaRapida(string $criterioRapido = ''): array {
        if (!$criterioRapido) {
            return self::buscarCriteros();
        } else {
            $sql = "
                select * from `categoria` 
                    where
                    (nombreCategoria like :nombre) OR
                    (descripcionCategoria like :descripcion)
                    (condicionCategoria like :condicion)";

            $conn = Db::getConexion(); 
            $pst = $conn->prepare($sql);
            $pst->bindValue(':nombre', "%$criterioRapido%"); 
            $pst->bindValue(':descripcion', "% $criterioRapido%");
            $pst->bindValue(':condicion', "% $criterioRapido%");
            $pst->execute(); 
            $resultado = $pst->fetchAll(); 
            $listaCategorias = self::listaArreglosAListaCategorias($resultado); 
            return $listaCategorias; 
        }
    }

    public static function crearDesdeParametros(array $parametros): self {
        $id = !empty($parametros['idCategoria']) ? intval($parametros['idCategoria']) : null;
        $nombre = $parametros['nombreCategoria'] ?? null;
        $descripcion = $parametros['descripcionCategoria'] ?? null;
        $condicion = $parametros['condicionCategoria'] ?? 1;
        $categoria = new Categoria($nombre, $descripcion, $condicion, $id);
        return $categoria;
    }
    
}
