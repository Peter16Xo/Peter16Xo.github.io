<?php
require_once "./config/conexion.php";
require_once "./models/dao/loginDAO.php";
require_once "./models/dto/loginDTO.php";

class loginController extends conexion {

    private $loginDAO;

    public function __construct() {
        $this->loginDAO = new loginDAO();
    }

    /* Controlador para iniciar sesion - Controller to log in */
    public function login_session_start_controller() {

        $userName = self::clean_string($_POST['loginUserName']);
        $userPass = self::clean_string($_POST['loginUserPass']);

        $userPass = self::encryption($userPass);

        $loginDTO = new loginDTO($userName, $userPass);

        if ($dataAccount = $this->loginDAO->login_session_start_model($loginDTO)) {
            if ($dataAccount->rowCount() == 1) {
                $row = $dataAccount->fetch();
                session_start();
                $_SESSION['userName'] = $row['Usuario'];
                $_SESSION['userType'] = $row['Tipo'];
                $_SESSION['userKey'] = $row['Codigo'];
                $_SESSION['userPrivilege'] = $row['Privilegio'];
                $_SESSION['userToken'] = md5(uniqid(mt_rand(), true));

                if ($row['Tipo'] == "Administrador") {
                    $_SESSION['Avatar'] = "avatar-chef.png";
                    $url = SERVERURL . "dashboard/";
                } elseif ($row['Tipo'] == "Profesor") {
                    $_SESSION['Avatar'] = "avatar-profesor.png"; // Añade la ruta del avatar para profesor si aplica
                    $url = SERVERURL . "dashboard/";
                } elseif ($row['Tipo'] == "Estudiante") {
                    if ($row['Genero'] == "Masculino") {
                        $_SESSION['Avatar'] = "avatar-user-male.png";
                    } else {
                        $_SESSION['Avatar'] = "avatar-user-female.png";
                    }
                    $url = SERVERURL . "home/";
                }

                $urlLocation = '<script type="text/javascript"> window.location="' . $url . '"; </script>';
                return $urlLocation;
            } else {
                $dataAlert = [
                    "title" => "Ocurrió un error inesperado",
                    "text" => "El nombre de usuario y contraseña no son correctos",
                    "type" => "error"
                ];
                return self::sweet_alert_single($dataAlert);
            }
        } else {
            $dataAlert = [
                "title" => "Ocurrió un error inesperado",
                "text" => "No se pudo realizar la petición",
                "type" => "error"
            ];
            return self::sweet_alert_single($dataAlert);
        }
    }

    /* Controlador para destruir sesion - Controller to destroy session */
    public function login_session_destroy_controller() {
        $token = $_POST['token'];
        $data = [
            "userName" => $_SESSION['userName'],
            "userToken" => $_SESSION['userToken'],
            "token" => $token
        ];
        if ($this->loginDAO->login_session_destroy_model($data)) {
            $urlLocation = '<script type="text/javascript"> window.location="' . SERVERURL . 'login/"; </script>';
            return $urlLocation;
        } else {
            $dataAlert = [
                "title" => "Ocurrió un error inesperado",
                "text" => "No se pudo cerrar la sesión",
                "type" => "error"
            ];
            return self::sweet_alert_single($dataAlert);
        }
    }

    /* Controlador para destruir sesion forzada - Controller to destroy session force */
    public function login_session_force_destroy_controller() {
        $token = $_SESSION['userToken'];
        $data = [
            "userName" => $_SESSION['userName'],
            "userToken" => $_SESSION['userToken'],
            "token" => $token
        ];
        if ($this->loginDAO->login_session_destroy_model($data)) {
            $urlLocation = '<script type="text/javascript"> window.location="' . SERVERURL . 'login/"; </script>';
            return $urlLocation;
        } else {
            $dataAlert = [
                "title" => "Ocurrió un error inesperado",
                "text" => "No se pudo cerrar la sesión",
                "type" => "error"
            ];
            return self::sweet_alert_single($dataAlert);
        }
    }

    /*=== Check Access Controller ====*/
    public function check_access($userToken, $userVar) {
        if (!isset($userToken) || !isset($userVar)) {
            session_start();
            session_destroy();
            return header("Location: " . SERVERURL . "login/");
        }
    }
}
