<?php
require_once "./config/conexion.php";
require_once "./models/dto/courseDTO.php";
require_once "./models/dao/courseDAO.php";
require_once "./controllers/teacherController.php";

class courseController extends conexion {

    private $courseDAO;
    private $teacherController;

    public function __construct() {
        $this->courseDAO = new courseDAO();
        $this->teacherController = new teacherController();
    }

    /*----------  Add course Controller  ----------*/
    public function add_course_controller() {
        $name = self::clean_string($_POST['name']);
        $description = self::clean_string($_POST['description']);
        $codigo_profesor = self::clean_string($_POST['codigo_profesor']);

        $courseDTO = new courseDTO(null, $name, $description, $codigo_profesor);

        if ($this->courseDAO->add_course_model($courseDTO)) {
            $dataAlert = [
                "title" => "Curso registrado!",
                "text" => "El curso se registr&oacute;n con &eacute;xito en el sistema",
                "type" => "success"
            ];
            unset($_POST);
            return self::sweet_alert_single($dataAlert);
        } else {
            $dataAlert = [
                "title" => "Ocurri&oacute; un error inesperado!",
                "text" => "No hemos podido registrar el curso, por favor intente nuevamente",
                "type" => "error"
            ];
            return self::sweet_alert_single($dataAlert);
        }
    }


    /*----------  Data course Controller  ----------*/
    public function data_course_controller($Type, $id) {
        $Type = self::clean_string($Type);
        $id = self::clean_string($id);

        $data = [
            "Tipo" => $Type,
            "id" => $id
        ];

        if ($coursedata = $this->courseDAO->data_course_model($data)) {
            return $coursedata;
        } else {
            $dataAlert = [
                "title" => "Ocurri&oacute; un error inesperado!",
                "text" => "No hemos podido seleccionar los datos del curso",
                "type" => "error"
            ];
            return self::sweet_alert_single($dataAlert);
        }
    }

    /*----------  Pagination course Controller  ----------*/
    public function pagination_course_controller($Pagina, $Registros) {
        $Pagina = self::clean_string($Pagina);
        $Registros = self::clean_string($Registros);

        $Pagina = (isset($Pagina) && $Pagina > 0) ? floor($Pagina) : 1;

        $Inicio = ($Pagina > 0) ? (($Pagina * $Registros) - $Registros) : 0;

        $Datos = self::execute_single_query("SELECT * FROM cursos ORDER BY Nombre ASC LIMIT $Inicio, $Registros");
        $Datos = $Datos->fetchAll();

        $Total = self::execute_single_query("SELECT * FROM cursos");
        $Total = $Total->rowCount();

        $Npaginas = ceil($Total / $Registros);

        $table = '
        <table class="table text-center">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Descripci&oacute;n</th>
                    <th class="text-center">Actualizar</th>
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
                    <td>' . $rows['Nombre'] . '</td>
                    <td>' . $rows['Descripcion'] . '</td>
                    <td>
                        <a href="' . SERVERURL . 'courseinfo/' . $rows['id'] . '/" class="btn btn-success btn-raised btn-xs">
                            <i class="zmdi zmdi-refresh"></i>
                        </a>
                    </td>
                    <td>
                        <a href="#!" class="btn btn-danger btn-raised btn-xs btnFormsAjax" data-action="delete" data-id="del-' . $rows['id'] . '">
                            <i class="zmdi zmdi-delete"></i>
                        </a>
                        <form action="" id="del-' . $rows['id'] . '" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="courseId" value="' . $rows['id'] . '">
                        </form>
                    </td>
                </tr>';
                $nt++;
            }
        } else {
            $table .= '
            <tr>
                <td colspan="5">No hay registros en el sistema</td>
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
                $table .= '<li><a href="' . SERVERURL . 'courselist/' . ($Pagina - 1) . '/">«</a></li>';
            }

            for ($i = 1; $i <= $Npaginas; $i++) {
                if ($Pagina == $i) {
                    $table .= '<li class="active"><a href="' . SERVERURL . 'courselist/' . $i . '/">' . $i . '</a></li>';
                } else {
                    $table .= '<li><a href="' . SERVERURL . 'courselist/' . $i . '/">' . $i . '</a></li>';
                }
            }

            if ($Pagina == $Npaginas) {
                $table .= '<li class="disabled"><a>»</a></li>';
            } else {
                $table .= '<li><a href="' . SERVERURL . 'courselist/' . ($Pagina + 1) . '/">»</a></li>';
            }

            $table .= '
                    </ul>
                </nav>';
        }

        return $table;
    }

    /*----------  Delete course Controller  ----------*/
    public function delete_course_controller($id) {
        $id = self::clean_string($id);

        if ($this->courseDAO->delete_course_model($id)) {
            $dataAlert = [
                "title" => "Curso eliminado!",
                "text" => "El curso ha sido eliminado del sistema satisfactoriamente",
                "type" => "success"
            ];
            return self::sweet_alert_single($dataAlert);
        } else {
            $dataAlert = [
                "title" => "¡Ocurri&oacute; un error inesperado!",
                "text" => "No pudimos eliminar el curso por favor intente nuevamente",
                "type" => "error"
            ];
            return self::sweet_alert_single($dataAlert);
        }
    }

    /*----------  Update course Controller  ----------*/
    public function update_course_controller() {
        $id = self::clean_string($_POST['id']);
        $name = self::clean_string($_POST['name']);
        $description = self::clean_string($_POST['description']);
        $codigo_profesor = self::clean_string($_POST['codigo_profesor']);

        $courseDTO = new courseDTO($id, $name, $description, $codigo_profesor);

        if ($this->courseDAO->update_course_model($courseDTO)) {
            $dataAlert = [
                "title" => "Curso actualizado!",
                "text" => "Los datos del curso fueron actualizados con &eacute;xito",
                "type" => "success"
            ];
            return self::sweet_alert_single($dataAlert);
        } else {
            $dataAlert = [
                "title" => "¡Ocurri&oacute; un error inesperado!",
                "text" => "No hemos podido actualizar los datos del curso, por favor intente nuevamente",
                "type" => "error"
            ];
            return self::sweet_alert_single($dataAlert);
        }
    }

    public function get_all_courses() {
    if($_SESSION['userType'] == "Profesor") {
        $codigo_profesor = $_SESSION['userKey']; 
        return $this->courseDAO->get_courses_by_professor($codigo_profesor);
    } else {
        return $this->courseDAO->get_all_courses_with_professors();
    }
}


    public function get_all_teachers() {
        return $this->teacherController->get_all_teachers();
    }
}
?>
