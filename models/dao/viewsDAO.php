<?php
require_once "./config/conexion.php";

class viewsDAO extends conexion {

    public function get_views_model($viewDTO){
        $views = $viewDTO->getView();
        if(
            $views == "home" ||
            $views == "dashboard" ||
            $views == "admin" ||
            $views == "adminlist" ||
            $views == "admininfo" ||
            $views == "account" ||
            $views == "teacher" ||
            $views == "student" ||
            $views == "studentlist" ||
            $views == "teacherlist" ||
            $views == "studentinfo" ||
            $views == "teacherinfo" ||
            $views == "course" ||
            $views == "courselist" ||
            $views == "courseinfo" ||
            $views == "class" ||
            $views == "classlist" ||
            $views == "classinfo" ||
            $views == "classview" ||
            $views == "videonow" ||
            $views == "videolist" ||
            $views == "search"
        ){
            if(is_file("./views/contents/".$views."-view.php")){
                $contents="./views/contents/".$views."-view.php";
            }else{
                $contents="login";
            }
        }elseif($views == "index" || $views == "login"){
            $contents="login";
        }else{
            $contents="login";
        }
        return $contents;
    }
}
?>
