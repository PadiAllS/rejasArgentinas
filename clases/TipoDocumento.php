<?php

namespace app\clases;

/**
 * Description of TipoDocumento
 *
 * @author norberto
 */
class TipoDocumento {
    private $tipoDoc = ['DNI', 'CI', 'LC', 'LE'];
    public function getTipoDoc(){
        return $this->tipoDoc;
    }
}
