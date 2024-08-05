<?php
class adminDTO {
    private $codigo;
    private $nombres;
    private $apellidos;

    public function __construct($codigo, $nombres, $apellidos) {
        $this->codigo = $codigo;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function getNombres() {
        return $this->nombres;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }
}
?>
