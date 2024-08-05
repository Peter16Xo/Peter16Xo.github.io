<?php
    require_once "./config/conexion.php";
    require_once "./models/dto/adminDTO.php";


class adminDAO extends conexion {

    public function addAdmin(adminDTO $admin) {
        $codigo = $admin->getCodigo();
        $nombres = $admin->getNombres();
        $apellidos = $admin->getApellidos();
        
        $query = self::connect()->prepare("INSERT INTO admin(Codigo, Nombres, Apellidos) VALUES(:Codigo, :Nombres, :Apellidos)");
        $query->bindParam(":Codigo", $codigo);
        $query->bindParam(":Nombres", $nombres);
        $query->bindParam(":Apellidos", $apellidos);
        $query->execute();
        return $query;
    }

    public function getAdminData($data) {
        if ($data['Tipo'] == "Count") {
            $query = self::connect()->prepare("SELECT Codigo FROM admin");
        } elseif ($data['Tipo'] == "Only") {
            $codigo = $data['Codigo'];
            $query = self::connect()->prepare("SELECT * FROM admin WHERE Codigo=:Codigo");
            $query->bindParam(":Codigo", $codigo);
        }
        $query->execute();
        return $query;
    }

    public function deleteAdmin($codigo) {
        $query = self::connect()->prepare("DELETE FROM admin WHERE Codigo=:Codigo");
        $query->bindParam(":Codigo", $codigo);
        $query->execute();
        return $query;
    }

    public function updateAdmin(adminDTO $admin) {
        $codigo = $admin->getCodigo();
        $nombres = $admin->getNombres();
        $apellidos = $admin->getApellidos();
        
        $query = self::connect()->prepare("UPDATE admin SET Nombres=:Nombres, Apellidos=:Apellidos WHERE Codigo=:Codigo");
        $query->bindParam(":Nombres", $nombres);
        $query->bindParam(":Apellidos", $apellidos);
        $query->bindParam(":Codigo", $codigo);
        $query->execute();
        return $query;
    }
}
?>
