<?php
require_once "./config/conexion.php";
require_once "./models/dao/viewsDAO.php";
require_once "./models/dto/viewsDTO.php";

class viewsController {

    private $viewsDAO;

    public function __construct() {
        $this->viewsDAO = new viewsDAO();
    }

    /*----------  Get Template  ----------*/
    public function get_template(){
        require_once "./views/template.php";
    }

    /*----------  Get Views Controller  ----------*/
    public function get_views_controller(){
        if(isset($_GET['views'])){
            $route=explode("/", $_GET['views']);
            $view=$route[0];
            $viewDTO = new viewsDTO($view);
            $response = $this->viewsDAO->get_views_model($viewDTO);
        }else{
            $response="login";
        }
        return $response;
    }
}
?>
