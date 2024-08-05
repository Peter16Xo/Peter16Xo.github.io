<?php
    require_once "./config/conexion.php";
    require_once "./models/dto/loginDTO.php";

class loginDAO extends conexion {

    /* Modelo para iniciar sesion - Model to log in */
    public function login_session_start_model(loginDTO $login) {
        $usuario = $login->getUsuario();
        $clave = $login->getClave();

        $query = self::connect()->prepare("SELECT * FROM cuenta WHERE Usuario=:Usuario AND Clave=:Clave");
        $query->bindParam(":Usuario", $usuario);
        $query->bindParam(":Clave", $clave);
        $query->execute();
        return $query;
    }

    /* Modelo para destruir sesion - Model to destroy session */
    public function login_session_destroy_model($data) {
        if ($data['userName'] != "" && $data['userToken'] == $data['token']) {
            session_destroy();
            return true;
        } else {
            return false;
        }
    }
}
?>
