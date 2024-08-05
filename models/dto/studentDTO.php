<?php
class studentDTO {
    private $codigo;
    private $nombres;
    private $apellidos;
    private $email;

    public function __construct($codigo, $nombres, $apellidos, $email) {
        $this->codigo = $codigo;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->email = $email;
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

    public function getEmail() {
        return $this->email;
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

    public function setEmail($email) {
        $this->email = $email;
    }
}
?>
