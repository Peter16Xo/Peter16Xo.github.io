<?php
require_once "./config/conexion.php";
require_once "./models/dto/teacherDTO.php";

class teacherDAO extends conexion {

    /*----------  Add teacher Model  ----------*/
    public function add_teacher_model(teacherDTO $teacher) {
        $codigo = $teacher->getCodigo();
        $nombres = $teacher->getNombres();
        $apellidos = $teacher->getApellidos();
        $email = $teacher->getEmail();

        $query = self::connect()->prepare("INSERT INTO profesores(Codigo, Nombres, Apellidos, Email) VALUES(:Codigo, :Nombres, :Apellidos, :Email)");
        $query->bindParam(":Codigo", $codigo);
        $query->bindParam(":Nombres", $nombres);
        $query->bindParam(":Apellidos", $apellidos);
        $query->bindParam(":Email", $email);
        $query->execute();
        return $query;
    }

    /*----------  Add account Model  ----------*/
    public function add_account_model($data) {
        $privilegio = $data['Privilegio'];
        $usuario = $data['Usuario'];
        $clave = $data['Clave'];
        $tipo = $data['Tipo'];
        $genero = $data['Genero'];
        $codigo = $data['Codigo'];

        $query = self::connect()->prepare("INSERT INTO cuenta(Privilegio, Usuario, Clave, Tipo, Genero, Codigo) VALUES(:Privilegio, :Usuario, :Clave, :Tipo, :Genero, :Codigo)");
        $query->bindParam(":Privilegio", $privilegio);
        $query->bindParam(":Usuario", $usuario);
        $query->bindParam(":Clave", $clave);
        $query->bindParam(":Tipo", $tipo);
        $query->bindParam(":Genero", $genero);
        $query->bindParam(":Codigo", $codigo);
        $query->execute();
        return $query;
    }

    /*----------  Data teacher Model  ----------*/
    public function data_teacher_model($data) {
        if ($data['Tipo'] == "Count") {
            $query = self::connect()->prepare("SELECT Codigo FROM profesores");
        } elseif ($data['Tipo'] == "Only") {
            $codigo = $data['Codigo'];
            $query = self::connect()->prepare("SELECT * FROM profesores WHERE Codigo=:Codigo");
            $query->bindParam(":Codigo", $codigo);
        }
        $query->execute();
        return $query;
    }

    /*----------  Delete teacher Model  ----------*/
    public function delete_teacher_model($codigo) {
        $query = self::connect()->prepare("DELETE FROM profesores WHERE Codigo=:Codigo");
        $query->bindParam(":Codigo", $codigo);
        $query->execute();
        return $query;
    }

    /*----------  Delete account Model  ----------*/
    public function delete_account_model($codigo) {
        $query = self::connect()->prepare("DELETE FROM cuenta WHERE Codigo=:Codigo");
        $query->bindParam(":Codigo", $codigo);
        $query->execute();
        return $query;
    }

    /*----------  Update teacher Model  ----------*/
    public function update_teacher_model(teacherDTO $teacher) {
        $codigo = $teacher->getCodigo();
        $nombres = $teacher->getNombres();
        $apellidos = $teacher->getApellidos();
        $email = $teacher->getEmail();

        $query = self::connect()->prepare("UPDATE profesores SET Nombres=:Nombres, Apellidos=:Apellidos, Email=:Email WHERE Codigo=:Codigo");
        $query->bindParam(":Nombres", $nombres);
        $query->bindParam(":Apellidos", $apellidos);
        $query->bindParam(":Email", $email);
        $query->bindParam(":Codigo", $codigo);
        $query->execute();
        return $query;
    }

    public function get_all_teachers() {
        $query = self::connect()->prepare("SELECT * FROM profesores");
        $query->execute();
        return $query->fetchAll();
    }
}
?>
