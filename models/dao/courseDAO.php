<?php
require_once "./config/conexion.php";
require_once "./models/dto/courseDTO.php";

class courseDAO extends conexion {

    /*----------  Add course Model  ----------*/
    public function add_course_model(courseDTO $course) {
        $nombre = $course->getNombre();
        $descripcion = $course->getDescripcion();
        $codigo_profesor = $course->getCodigoProfesor();

        $query = self::connect()->prepare("INSERT INTO cursos(Nombre, Descripcion, Codigo_profesor) VALUES(:Nombre, :Descripcion, :Codigo_profesor)");
        $query->bindParam(":Nombre", $nombre);
        $query->bindParam(":Descripcion", $descripcion);
        $query->bindParam(":Codigo_profesor", $codigo_profesor);
        $query->execute();
        return $query;
    }

    public function get_all_courses_with_professors() {
        $query = self::connect()->prepare("
            SELECT cursos.id, cursos.Nombre, cursos.Descripcion, profesores.Nombres AS profesorNombre, profesores.Apellidos AS profesorApellido
            FROM cursos
            JOIN profesores ON cursos.Codigo_profesor = profesores.Codigo
        ");
        $query->execute();
        return $query->fetchAll();
    }

    public function get_courses_by_professor($codigo_profesor) {
        $query = self::connect()->prepare("
            SELECT cursos.id, cursos.Nombre, cursos.Descripcion, profesores.Nombres AS profesorNombre, profesores.Apellidos AS profesorApellido
            FROM cursos
            JOIN profesores ON cursos.Codigo_profesor = profesores.Codigo
            WHERE cursos.Codigo_profesor = :codigo_profesor
        ");
        $query->bindParam(":codigo_profesor", $codigo_profesor);
        $query->execute();
        return $query->fetchAll();
    }


    /*----------  Get All Courses Model  ----------*/
    public function get_all_courses_model() {
        $query = self::connect()->prepare("SELECT * FROM cursos");
        $query->execute();
        return $query->fetchAll();
    }

    /*----------  Data course Model  ----------*/
    public function data_course_model($data) {
        if ($data['Tipo'] == "Count") {
            $query = self::connect()->prepare("SELECT id FROM cursos");
        } elseif ($data['Tipo'] == "Only") {
            $id = $data['id'];
            $query = self::connect()->prepare("SELECT * FROM cursos WHERE id=:id");
            $query->bindParam(":id", $id);
        }
        $query->execute();
        return $query;
    }


    /*----------  Delete course Model  ----------*/
    public function delete_course_model($id) {
        $query = self::connect()->prepare("DELETE FROM cursos WHERE id=:id");
        $query->bindParam(":id", $id);
        $query->execute();
        return $query;
    }

    /*----------  Update course Model  ----------*/
    public function update_course_model(courseDTO $course) {
        $nombre = $course->getNombre();
        $descripcion = $course->getDescripcion();
        $codigo_profesor = $course->getCodigoProfesor();
        $id = $course->getId();

        $query = self::connect()->prepare("UPDATE cursos SET Nombre=:Nombre, Descripcion=:Descripcion, Codigo_profesor=:Codigo_profesor WHERE id=:id");
        $query->bindParam(":Nombre", $nombre);
        $query->bindParam(":Descripcion", $descripcion);
        $query->bindParam(":Codigo_profesor", $codigo_profesor);
        $query->bindParam(":id", $id);
        $query->execute();
        return $query;
    }
}
?>
