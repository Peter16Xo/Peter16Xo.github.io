<?php
class courseDTO {
    private $id;
    private $nombre;
    private $descripcion;
    private $codigo_profesor;

    public function __construct($id, $nombre, $descripcion, $codigo_profesor) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->codigo_profesor = $codigo_profesor;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getCodigoProfesor() {
        return $this->codigo_profesor;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setCodigoProfesor($codigo_profesor) {
        $this->codigo_profesor = $codigo_profesor;
    }
}
