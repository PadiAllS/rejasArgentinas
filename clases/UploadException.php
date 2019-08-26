<?php
namespace app\clases;
use Exception;

class UploadException extends Exception
{
    public function __construct($code) {
        $message = $this->codeToMessage($code);
        parent::__construct($message, $code);
    }

    private function codeToMessage($code)
    {
        switch ($code) {
            case UPLOAD_ERR_INI_SIZE:
                $message = "El archivo cargado excede la directiva upload_max_filesize en php.ini";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $message = "El archivo cargado excede la directiva MAX_FILE_SIZE que se especificó en el formulario HTML";
                break;
            case UPLOAD_ERR_PARTIAL:
                $message = "El archivo subido solo se subió parcialmente";
                break;
            case UPLOAD_ERR_NO_FILE:
                $message = "No se cargó ningún archivo";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $message = "Falta una carpeta temporal";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $message = "Error al escribir el archivo en el disco";
                break;
            case UPLOAD_ERR_EXTENSION:
                $message = "Carga de archivos detenida por extensión";
                break;
            default:
                $message = "Error de carga desconocido";
                break;
        }
        return $message;
    }
}


