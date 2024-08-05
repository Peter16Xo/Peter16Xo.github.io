<?php
class loginDTO {
    private $usuario;
    private $clave;

    public function __construct($usuario, $clave) {
        $this->usuario = $usuario;
        $this->clave = $clave;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getClave() {
        return $this->clave;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function setClave($clave) {
        $this->clave = $clave;
    }
}
?>
