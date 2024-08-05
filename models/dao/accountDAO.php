<?php
require_once "./config/conexion.php";
require_once "./models/dto/accountDTO.php";

class accountDAO extends conexion {

    public function data_account($codigo) {
        $query = self::connect()->prepare("SELECT * FROM cuenta WHERE Codigo=:Codigo");
        $query->bindParam(":Codigo", $codigo);
        $query->execute();
        return $query->fetch();
    }

    public function update_account($data) {
        if ($data instanceof accountDTO) {
            $codigo = $data->getCodigo();
            $usuario = $data->getUsuario();
            $clave = $data->getClave();
            $genero = $data->getGenero();

            $dataArray = [
                "Codigo" => $codigo,
                "Usuario" => $usuario,
                "Clave" => $clave,
                "Genero" => $genero
            ];

            return parent::update_account($dataArray);
        } else {
            // Handle error or exception if $data is not an instance of accountDTO
            throw new InvalidArgumentException("Expected instance of accountDTO");
        }
    }
}
?>
