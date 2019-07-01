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


    function __constuct($id, $username, $password, $permiso=null)
    {
        $this->clienteId = $id;
        $this->username = $username;
        $this->password = $password;
        $this->permiso = $permiso;
    }
    
    public function esLoginValido(string $usuario, string $password): bool{
        $sql = 'select * from usuario where username = :usuario';
        $pst = $this->bd->prepare($sql);
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
        // $sql = 'insert into usuario (clienteId, userName, password) values (:clienteId, :usuario, :password)';
        $pst = $conn->prepare('INSERT INTO usuario (clienteId, userName, password) VALUES (:clienteId, :username, :password');
        $pst->bindValue(':clienteId', $this->clienteId, PDO::PARAM_INT);
        $pst->bindValue(':username', $this->username, PDO::PARAM_STR);
        $hashPass = password_hash($this->password, PASSWORD_DEFAULT);
        $pst->bindValue(':password', $hashPass, PDO::PARAM_STR);
        $pst->execute();
        if($pst->rowCount()===1){
            return true; 
        }else{
            return false;
        }
        
    }
        public static function crearDesdeParametros(array $parametros): self {
        $id = $parametros['idCliente'] ?? null;
        $username = $parametros['username'] ?? null;
        $password = $parametros['password'] ?? null;
        $user = new Usuario($id, $username, $password);
        return $user;
    }

    
}




