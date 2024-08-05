<?php
class accountDTO {
    private $codigo;
    private $usuario;
    private $clave;
    private $genero;

    public function __construct($codigo, $usuario, $clave, $genero) {
        $this->codigo = $codigo;
        $this->usuario = $usuario;
        $this->clave = $clave;
        $this->genero = $genero;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getClave() {
        return $this->clave;
    }

    public function getGenero() {
        return $this->genero;
    }
}
?>
