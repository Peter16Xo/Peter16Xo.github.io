<?php
class videoDTO {
    private $id;
    private $video;
    private $fecha;
    private $titulo;
    private $tutor;
    private $descripcion;
    private $adjuntos;

    public function __construct($video, $fecha, $titulo, $tutor, $descripcion, $adjuntos, $id = null) {
        $this->id = $id;
        $this->video = $video;
        $this->fecha = $fecha;
        $this->titulo = $titulo;
        $this->tutor = $tutor;
        $this->descripcion = $descripcion;
        $this->adjuntos = $adjuntos;
    }

    public function getId() {
        return $this->id;
    }

    public function getVideo() {
        return $this->video;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getTutor() {
        return $this->tutor;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getAdjuntos() {
        return $this->adjuntos;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setVideo($video) {
        $this->video = $video;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setTutor($tutor) {
        $this->tutor = $tutor;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setAdjuntos($adjuntos) {
        $this->adjuntos = $adjuntos;
    }
}
?>
