<?php
class commentDTO {
    private $id;
    private $comentario;
    private $adjunto;
    private $tipo;
    private $codigo;
    private $fecha;

    public function __construct($id, $comentario, $adjunto, $tipo, $codigo, $fecha) {
        $this->id = $id;
        $this->comentario = $comentario;
        $this->adjunto = $adjunto;
        $this->tipo = $tipo;
        $this->codigo = $codigo;
        $this->fecha = $fecha;
    }

    public function getId() {
        return $this->id;
    }

    public function getComentario() {
        return $this->comentario;
    }

    public function getAdjunto() {
        return $this->adjunto;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setComentario($comentario) {
        $this->comentario = $comentario;
    }

    public function setAdjunto($adjunto) {
        $this->adjunto = $adjunto;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }
}
?>
