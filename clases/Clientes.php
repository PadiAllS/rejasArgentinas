<?php


namespace app\clases;
require_once 'Db.php';
use app\clases\Db;
use \PDO;

/**
 * Description of Clientes
 *
 * @author norberto
 */
class Clientes {
    protected $idCliente;
    protected $nombreCliente;
    protected $tipoDocCliente;
    protected $nroDocCliente;
    protected $direccionCliente;
    protected $mailCliente;
    protected $telCliente;
    protected $errores;
            
            
            
    function __construct($nombre, $tipoDoc, $nroDoc, $direccion, $mail, $telefono, $idCliente= null) {
        
        $this->idCliente = $idCliente;
        $this->nombreCliente = $nombre;
        $this->tipoDocCliente= $tipoDoc;
        $this->nroDocCliente = $nroDoc;
        $this->direccionCliente = $direccion;
        $this->mailCliente = $mail;
        $this->telCliente = $telefono;
        $this->errores = [];
 
    }
    
    //geters cliente.
    public function getIdCliente()
    {
        return $this->idCliente;
    }
    
    public function getNombrecliente()
    {
        return $this->nombreCliente;
    }
    public function getTipoDoc()
    {
        return $this->tipoDocCliente;
    }
    public function getNroDoc()
    {
        return $this->nroDocCliente;
    }
    public function getTipoyNroDoc()
    {
        return $this->tipoDocCliente.$this->nroDocCliente;
    }
    public function getDireccionCliente()
    {
        return $this->direccionCliente;
    }
    public function getMailCliente()
    {
        return $this->mailCliente;
    }
    public function getTelCliente()
    {
        return $this->telCliente;
    }
    
    // seters cliente.
    public function setIdCliente($val) 
    {
        $this->idCliente = intval($val);
    }

    public function insertar(): bool {
        if (!$this->esPersonaValida()) {
            return false;
        }
        $sql = 'INSERT INTO cliente (nombreCliente, tipoDocCliente, nroDocCliente, direccionCliente, mailCliente, telCliente)'
                . ' values (:nombre, :tipoDoc, :nroDoc, :direccion, :mail, :telefono)';

        $conn = Db::getConexion(); 
        $pst = $conn->prepare($sql);
        $pst->bindValue(':nombre', $this->nombreCliente);
        $pst->bindValue(':tipoDoc', $this->tipoDocCliente);
        $pst->bindValue(':nroDoc', $this->nroDocCliente);
        $pst->bindValue(':direccion', $this->direccionCliente);
        $pst->bindValue(':mail', $this->mailCliente);
        $pst->bindValue(':telefono', $this->telCliente);
        $pst->execute(); 
        if ($pst->rowCount() === 1) {
            $numerodeID = $conn->lastInsertId();
            $this->setIdCliente($conn->lastInsertId()); 
            return true;
        } else {
            return false;
        }
        
    }
    public function actualizar(): bool {
        if (!$this->esPersonaValida()) {
            return false;
        }
        $sql= 'UPDATE cliente SET nombreCliente=:nombre, tipoDocCliente =:tipoDoc, nroDocCliente=:nroDoc, direccionCliente=:direccion, mailCliente=:mail, telCliente=:telefono WHERE idCliente=:idCliente';
        
    //    $sql = 'INSERT INTO cliente (nombreCliente, tipoDocCliente, nroDocCliente, direccionCliente, mailCliente, telCliente)'
    //            . ' values (:nombre, :tipoDoc, :nroDoc, :direccion, :mail, :telefono)';

        $conn = Db::getConexion(); 
        $pst = $conn->prepare($sql);
        $pst->bindValue(':nombre', $this->nombreCliente);
        $pst->bindValue(':tipoDoc', $this->tipoDocCliente);
        $pst->bindValue(':nroDoc', $this->nroDocCliente);
        $pst->bindValue(':direccion', $this->direccionCliente);
        $pst->bindValue(':mail', $this->mailCliente);
        $pst->bindValue(':telefono', $this->telCliente);
        $pst->bindValue(':idCliente', $this->idCliente);
        $pst->execute(); 
        if ($pst->rowCount() === 1) {
            return true;
        } else {
            return false;
        }
        
    }

    public function esPersonaValida(): bool 
    {
        if (strlen($this->nombreCliente) < 4)     
        {
            $this->errores[] = 'El nombre debe tener mas de 3 caracteres';
        }
        if ((strlen($this->nroDocCliente) < 4) && (is_numeric($this->nroDocCliente)))            
        {
            $this->errores[] = 'El documento debe tener mas de 3 caracteres y ser numerico';
        }
        if (strlen($this->direccionCliente) < 4) 
        {
            $this->errores[] = 'La direccion debe tener mas de 3 caracteres';
        }
        if (!filter_var($this->mailCliente, FILTER_VALIDATE_EMAIL)) 
        {
            $this->errores[] = 'Debe ingresar un mail valido xxxxxx@xxxx.com';
        }
        if ((strlen($this->telCliente) < 6) && (is_numeric($this->telCliente)))            
        {
            $this->errores[] = 'El telefono debe tener mas de 5 caracteres y ser numerico';
        }
        return count($this->errores) === 0;
    }

    public static function crearDesdeParametros(array $parametros): self {
        $id = !empty($parametros['idCliente']) ? intval($parametros['idCliente']) : null;
        $nombre = $parametros['nombreCliente'] ?? null;
        $tipoDoc = $parametros['tipoDocCliente'] ?? null;
        $nroDoc = $parametros['nroDocCliente'] ?? null;
        $direccion = $parametros['direccionCliente'] ?? null;
        $mail = $parametros['mailCliente'] ?? null;
        $telefono = $parametros['telCliente'] ?? null;
        $cliente = new Clientes($nombre, $tipoDoc, $nroDoc, $direccion, $mail, $telefono, $id);
        return $cliente;
    }

    public static function buscarCriteros(string $nombre = '', $direccion = ''): array {
        $sql = "
            select * from `cliente` 
                where
                ( (nombreCliente like :nombre) OR (:nombretest = '') ) AND
                ( (direccionCliente like :direccion) OR (:direcciontest = '') ) 
                ";

        $conn = Db::getConexion(); 
        $pst = $conn->prepare($sql); 
         $pst->bindValue(':nombre', '%'.$nombre.'%');
        $pst->bindValue(':nombretest', $nombre);
        $pst->bindValue(':direccion', '%'.$direccion.'%');
        $pst->bindValue(':direcciontest', $direccion);
        $pst->execute(); 
        $resultado = $pst->fetchAll(); 
        $listaClientes = self::listaArreglosAListaClientes($resultado); 
        return $listaClientes; 
    }

    private static function listaArreglosAListaClientes(array $listaArreglo): array {
        $resultado = [];
        foreach ($listaArreglo as $nuevoCliente) {
            $resultado[] = Clientes::crearDesdeParametros($nuevoCliente);
        }
        return $resultado;
    }

    public static function busquedaRapida(string $criterioRapido = ''): array {
        if (!$criterioRapido) {
            return self::buscarCriteros();
        } else {
            $sql = "
                select * from `cliente` 
                    where
                    (nombreCliente like :nombre) OR
                    (direccionCliente like :direccion)";

            $conn = Db::getConexion(); 
            $pst = $conn->prepare($sql);
            $pst->bindValue(':nombre', '%'.$criterioRapido.'%'); 
            $pst->bindValue(':direccion', '%'.$criterioRapido.'%');
            $pst->execute(); 
            $resultado = $pst->fetchAll(); 
            $listaClientes = self::listaArreglosAListaClientes($resultado); 
            return $listaClientes; 
        }
    }
    
    public static function buscarPorId(int $id): self
    {
        $conexion = Db::getConexion();
        $pst = $conexion->prepare('select * from cliente where idCliente = :id');
        $pst->bindValue(':id', $id);
        $pst->execute();
        $clienteArray = $pst->fetch();
        // si no hay coincidencia disparo una excepción
        if($clienteArray===FALSE){
            throw new NullObjectError('Objeto inexistente');
        }
        
        return new Clientes($clienteArray['nombreCliente'], $clienteArray['tipoDocCliente'], $clienteArray['nroDocCliente'], $clienteArray['direccionCliente'], $clienteArray['mailCliente'], $clienteArray['telCliente'], $clienteArray['idCliente']);
    }
    
    public function eliminar(): bool {
    
        $sql = 'delete from cliente where idCliente = :id';
        $conn = Db::getConexion();
        $pst = $conn->prepare($sql);
        $pst->bindValue(':id', $this->idCliente);
        $clienteArray = $pst->execute();
        if ($clienteArray === FALSE) {
            throw new NullObjectError('Objeto inexistente');
        }
        return true;
    }

}