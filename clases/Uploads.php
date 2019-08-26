<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\clases;

require_once 'UploadException.php';
use app\clases\UploadException;
use Throwable;


/**
 * Description of Uploads
 *
 * @author mariano
 */
class Uploads {
    private $directorio = '';
    private $atributo = '';
    private $errores = '';
    private $archivoCargado = '';
    
    public function __construct(string $directorio, string $atributo) 
    {
        $this->atributo = $atributo;
        $this->directorio = $directorio;
    }
    
    public function getArchivoCargado(): string
    {
        return $this->archivoCargado;
    }
    
    /**
     * analiza la variable global $_FILE y almacena los archivos
     */
    public function procesarUpload(): bool
    {
        try {
            // si hay un error, disparo una excepción específica
            if($_FILES[$this->atributo]['error']!==UPLOAD_ERR_OK){
                throw new UploadException($_FILES[$this->atributo]['error']);
            }
            
            $nombreArchivoSubido = basename($_FILES[$this->atributo]['name']);
            // agregamos un código que evite las colisiones;
            $nuevoNombreArchivo = $nombreArchivoSubido.'-'.uniqid();

            $fichero_subido = $this->directorio . $nuevoNombreArchivo;
            if (move_uploaded_file($_FILES[$this->atributo]['tmp_name'], $fichero_subido)) {
                $this->archivoCargado = $fichero_subido;
                return true;
            } else {
                $this->errores = 'error al subir archivo';
                return false;
            }         
        } catch (UploadException $excepcion){
            $this->errores = $excepcion->getMessage();
            return false;
        } catch (Throwable $e){
            $this->errores = $e->getMessage();
            return false;
        }        
    }
    
    public function getErrores(): string
    {
        return $this->errores;
    }
            
}
