<?php
require_once "./config/conexion.php";
require_once "./models/dto/studentDTO.php";

class studentDAO extends conexion {

    /*----------  Add Student Model  ----------*/
    public function add_student_model(studentDTO $student) {
        $codigo = $student->getCodigo();
        $nombres = $student->getNombres();
        $apellidos = $student->getApellidos();
        $email = $student->getEmail();

        $query = self::connect()->prepare("INSERT INTO estudiante(Codigo, Nombres, Apellidos, Email) VALUES(:Codigo, :Nombres, :Apellidos, :Email)");
        $query->bindParam(":Codigo", $codigo);
        $query->bindParam(":Nombres", $nombres);
        $query->bindParam(":Apellidos", $apellidos);
        $query->bindParam(":Email", $email);
        $query->execute();
        return $query;
    }

    /*----------  Data Student Model  ----------*/
    public function data_student_model($data) {
        if ($data['Tipo'] == "Count") {
            $query = self::connect()->prepare("SELECT Codigo FROM estudiante");
        } elseif ($data['Tipo'] == "Only") {
            $codigo = $data['Codigo'];
            $query = self::connect()->prepare("SELECT * FROM estudiante WHERE Codigo=:Codigo");
            $query->bindParam(":Codigo", $codigo);
        }
        $query->execute();
        return $query;
    }

    /*----------  Delete Student Model  ----------*/
    public function delete_student_model($codigo) {
        $query = self::connect()->prepare("DELETE FROM estudiante WHERE Codigo=:Codigo");
        $query->bindParam(":Codigo", $codigo);
        $query->execute();
        return $query;
    }

    /*----------  Update Student Model  ----------*/
    public function update_student_model(studentDTO $student) {
        $codigo = $student->getCodigo();
        $nombres = $student->getNombres();
        $apellidos = $student->getApellidos();
        $email = $student->getEmail();

        $query = self::connect()->prepare("UPDATE estudiante SET Nombres=:Nombres, Apellidos=:Apellidos, Email=:Email WHERE Codigo=:Codigo");
        $query->bindParam(":Nombres", $nombres);
        $query->bindParam(":Apellidos", $apellidos);
        $query->bindParam(":Email", $email);
        $query->bindParam(":Codigo", $codigo);
        $query->execute();
        return $query;
    }
}
?>
