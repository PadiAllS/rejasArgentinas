<?php
declare(strict_types=1);

namespace app\clases;
require_once 'Db.php';
use \PDO;


class Usuario {
    protected $clienteId;
    protected $username;
    protected $password;
    protected $permiso;

//    function __construct() {
//        ;
//    }

    public function __construct(int $id=null, string $username=null, string $password=null, string $permiso=null) {
        $this->clienteId= $id;
        $this->username= $username;
        $this->password= $password;
        $this->permiso= $permiso;
    }

    public function esLoginValido(string $username, string $password): bool{
        $conn= Db::getConexion();
        $sql = 'select * from usuario where userName = :usuario';
        $pst = $conn->prepare($sql);
        $pst->bindValue(':usuario', $username, PDO::PARAM_STR);
        $pst->execute();
        $resultados = $pst->fetchAll();
        if(count($resultados)===1){
            return password_verify($password, $resultados[0]['password']);
        }else{
            return false;
        }
    }
    
    public function insertar(): bool {
        $conn = Db::getConexion(); 
        $sql = 'INSERT INTO usuario (clienteId, userName, password) VALUES (:clienteId, :username, :password)';
        $pst = $conn->prepare($sql);
        $pst->bindValue(':clienteId', $this->clienteId, PDO::PARAM_INT);
        $pst->bindValue(':username', $this->username, PDO::PARAM_STR);
        $hashPass = password_hash($this->password, PASSWORD_DEFAULT);
        $pst->bindValue(':password', $hashPass, PDO::PARAM_STR);
  //      $pst->bindValue(':password', $this->password);
        $pst->execute();
        if($pst->rowCount()===1){
            return true; 
        }else{
            return false;
        }
        
    }
        public static function crearDesdeParametros(array $parametros): self {
        $id = intval($parametros['idCliente']) ?? null;
        $username = $parametros['username'] ?? null;
        $password = $parametros['password'] ?? null;
        $usuario = new Usuario($id, $username, $password);
        return $usuario;
    }

    public static function buscarPorId(int $id): self
    {
        $conexion = Db::getConexion();
        $stmt = $conexion->prepare('select * from usuario where clienteId = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $usuarioArray = $stmt->fetch();
        if($usuarioArray===FALSE){
            throw new NullObjectError('Objeto inexistente');
        }
        
        return new Usuario(intval($usuarioArray['clienteId']), $usuarioArray['userName'], $usuarioArray['password'], $usuarioArray['permiso']);
    }
    
    public function eliminar(): bool {
    
        $sql = 'delete from usuario where clienteId = :id';
        $conn = Db::getConexion();
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $this->id);
        $usuarioArray = $stmt->execute();
        if ($usuarioArray === FALSE) {
            throw new NullObjectError('Objeto inexistente');
        }
    }


}

