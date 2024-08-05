<?php
require_once "./config/conexion.php";
require_once "./models/dto/teacherDTO.php";
require_once "./models/dao/teacherDAO.php";

class teacherController extends conexion {

    private $teacherDAO;

    public function __construct() {
        $this->teacherDAO = new teacherDAO();
    }

    /*----------  Add teacher Controller  ----------*/
    public function add_teacher_controller() {
        $name = self::clean_string($_POST['name']);
        $lastname = self::clean_string($_POST['lastname']);
        $gender = self::clean_string($_POST['gender']);
        $email = self::clean_string($_POST['email']);
        $username = self::clean_string($_POST['username']);
        $password1 = self::clean_string($_POST['password1']);
        $password2 = self::clean_string($_POST['password2']);

        if ($password1 != "" || $password2 != "") {
            if ($password1 == $password2) {
                $query1 = self::execute_single_query("SELECT Usuario FROM cuenta WHERE Usuario='$username'");
                if ($query1->rowCount() <= 0) {
                    $query2 = self::execute_single_query("SELECT id FROM cuenta");
                    $correlative = ($query2->rowCount()) + 1;

                    $code = self::generate_code("PR", 7, $correlative);
                    $password1 = self::encryption($password1);

                    $dataAccount = [
                        "Privilegio" => 4,
                        "Usuario" => $username,
                        "Clave" => $password1,
                        "Tipo" => "Profesor",
                        "Genero" => $gender,
                        "Codigo" => $code
                    ];

                    $teacherDTO = new teacherDTO($code, $name, $lastname, $email);

                    if ($this->teacherDAO->add_account_model($dataAccount) && $this->teacherDAO->add_teacher_model($teacherDTO)) {
                        $dataAlert = [
                            "title" => "¡Profesor registrado!",
                            "text" => "El profesor se registró con éxito en el sistema",
                            "type" => "success"
                        ];
                        unset($_POST);
                        return self::sweet_alert_single($dataAlert);
                    } else {
                        $dataAlert = [
                            "title" => "¡Ocurrió un error inesperado!",
                            "text" => "No hemos podido registrar el profesor, por favor intente nuevamente",
                            "type" => "error"
                        ];
                        return self::sweet_alert_single($dataAlert);
                    }

                } else {
                    $dataAlert = [
                        "title" => "¡Ocurrió un error inesperado!",
                        "text" => "El nombre de usuario que acaba de ingresar ya se encuentra registrado en el sistema, por favor elija otro",
                        "type" => "error"
                    ];
                    return self::sweet_alert_single($dataAlert);
                }
            } else {
                $dataAlert = [
                    "title" => "¡Ocurrió un error inesperado!",
                    "text" => "Las contraseñas que acabas de ingresar no coinciden",
                    "type" => "error"
                ];
                return self::sweet_alert_single($dataAlert);
            }
        } else {
            $dataAlert = [
                "title" => "¡Ocurrió un error inesperado!",
                "text" => "Debes de llenar los campos de las contraseñas para registrar el profesor",
                "type" => "error"
            ];
            return self::sweet_alert_single($dataAlert);
        }
    }

    /*----------  Data teacher Controller  ----------*/
    public function data_teacher_controller($Type, $Code) {
        $Type = self::clean_string($Type);
        $Code = self::clean_string($Code);

        $data = [
            "Tipo" => $Type,
            "Codigo" => $Code
        ];

        if ($teacherdata = $this->teacherDAO->data_teacher_model($data)) {
            return $teacherdata;
        } else {
            $dataAlert = [
                "title" => "¡Ocurrió un error inesperado!",
                "text" => "No hemos podido seleccionar los datos del profesor",
                "type" => "error"
            ];
            return self::sweet_alert_single($dataAlert);
        }
    }

    /*----------  Pagination teacher Controller  ----------*/
    public function pagination_teacher_controller($Pagina, $Registros) {
        $Pagina = self::clean_string($Pagina);
        $Registros = self::clean_string($Registros);

        $Pagina = (isset($Pagina) && $Pagina > 0) ? floor($Pagina) : 1;

        $Inicio = ($Pagina > 0) ? (($Pagina * $Registros) - $Registros) : 0;

        $Datos = self::execute_single_query("SELECT * FROM profesores ORDER BY Nombres ASC LIMIT $Inicio, $Registros");
        $Datos = $Datos->fetchAll();

        $Total = self::execute_single_query("SELECT * FROM profesores");
        $Total = $Total->rowCount();

        $Npaginas = ceil($Total / $Registros);

        $table = '
        <table class="table text-center">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Nombres</th>
                    <th class="text-center">Apellidos</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">A. Datos</th>
                    <th class="text-center">A. Cuenta</th>
                    <th class="text-center">Eliminar</th>
                </tr>
            </thead>
            <tbody>';

        if ($Total >= 1) {
            $nt = $Inicio + 1;
            foreach ($Datos as $rows) {
                $table .= '
                <tr>
                    <td>' . $nt . '</td>
                    <td>' . $rows['Nombres'] . '</td>
                    <td>' . $rows['Apellidos'] . '</td>
                    <td>' . $rows['Email'] . '</td>
                    <td>
                        <a href="' . SERVERURL . 'teacherinfo/' . $rows['Codigo'] . '/" class="btn btn-success btn-raised btn-xs">
                            <i class="zmdi zmdi-refresh"></i>
                        </a>
                    </td>
                    <td>
                        <a href="' . SERVERURL . 'account/' . $rows['Codigo'] . '/" class="btn btn-success btn-raised btn-xs">
                            <i class="zmdi zmdi-refresh"></i>
                        </a>
                    </td>
                    <td>
                        <a href="#!" class="btn btn-danger btn-raised btn-xs btnFormsAjax" data-action="delete" data-id="del-' . $rows['Codigo'] . '">
                            <i class="zmdi zmdi-delete"></i>
                        </a>
                        <form action="" id="del-' . $rows['Codigo'] . '" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="teacherCode" value="' . $rows['Codigo'] . '">
                        </form>
                    </td>
                </tr>';
                $nt++;
            }
        } else {
            $table .= '
            <tr>
                <td colspan="7">No hay registros en el sistema</td>
            </tr>';
        }

        $table .= '
            </tbody>
        </table>';

        if ($Total >= 1) {
            $table .= '
                <nav class="text-center full-width">
                    <ul class="pagination pagination-sm">';

            if ($Pagina == 1) {
                $table .= '<li class="disabled"><a>«</a></li>';
            } else {
                $table .= '<li><a href="' . SERVERURL . 'teacherlist/' . ($Pagina - 1) . '/">«</a></li>';
            }

            for ($i = 1; $i <= $Npaginas; $i++) {
                if ($Pagina == $i) {
                    $table .= '<li class="active"><a href="' . SERVERURL . 'teacherlist/' . $i . '/">' . $i . '</a></li>';
                } else {
                    $table .= '<li><a href="' . SERVERURL . 'teacherlist/' . $i . '/">' . $i . '</a></li>';
                }
            }

            if ($Pagina == $Npaginas) {
                $table .= '<li class="disabled"><a>»</a></li>';
            } else {
                $table .= '<li><a href="' . SERVERURL . 'teacherlist/' . ($Pagina + 1) . '/">»</a></li>';
            }

            $table .= '
                    </ul>
                </nav>';
        }

        return $table;
    }

    /*----------  Delete teacher Controller  ----------*/
    public function delete_teacher_controller($code) {
        $code = self::clean_string($code);

        if ($this->teacherDAO->delete_account_model($code) && $this->teacherDAO->delete_teacher_model($code)) {
            $dataAlert = [
                "title" => "¡Profesor eliminado!",
                "text" => "El profesor ha sido eliminado del sistema satisfactoriamente",
                "type" => "success"
            ];
            return self::sweet_alert_single($dataAlert);
        } else {
            $dataAlert = [
                "title" => "¡Ocurrió un error inesperado!",
                "text" => "No pudimos eliminar el profesor por favor intente nuevamente",
                "type" => "error"
            ];
            return self::sweet_alert_single($dataAlert);
        }
    }

    /*----------  Update teacher Controller  ----------*/
    public function update_teacher_controller() {
        $code = self::clean_string($_POST['code']);
        $name = self::clean_string($_POST['name']);
        $lastname = self::clean_string($_POST['lastname']);
        $email = self::clean_string($_POST['email']);

        $teacherDTO = new teacherDTO($code, $name, $lastname, $email);

        if ($this->teacherDAO->update_teacher_model($teacherDTO)) {
            $dataAlert = [
                "title" => "¡Profesor actualizado!",
                "text" => "Los datos del profesor fueron actualizados con éxito",
                "type" => "success"
            ];
            return self::sweet_alert_single($dataAlert);
        } else {
            $dataAlert = [
                "title" => "¡Ocurrió un error inesperado!",
                "text" => "No hemos podido actualizar los datos del profesor, por favor intente nuevamente",
                "type" => "error"
            ];
            return self::sweet_alert_single($dataAlert);
        }
    }

    public function get_all_teachers() {
        return $this->teacherDAO->get_all_teachers();
    }
}
?>
