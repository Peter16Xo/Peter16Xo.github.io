<?php if($_SESSION['userType']=="Administrador"): ?>
<div class="container-fluid">
    <div class="page-header">
      <h1 class="text-titles"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Cursos <small>(Actualizar)</small></h1>
    </div>
    <p class="lead">
        Bienvenido a la secci&oacute;n de actualizaci&oacute;n de los datos de los cursos. Ac&aacute; podr&aacute; actualizar la informaci&oacute;n de los cursos registrados en el sistema.
    </p>
</div>
<?php 
    require_once "./controllers/courseController.php";

    $courseIns = new courseController();

    if(isset($_POST['id'])){
        echo $courseIns->update_course_controller();
    }

    $id=explode("/", $_GET['views']);

    $data=$courseIns->data_course_controller("Only", $id[1]);
    if($data->rowCount()>0):
        $rows=$data->fetch();
        $teachers = $courseIns->get_all_teachers();
?>
<p class="text-center">
    <a href="<?php echo SERVERURL; ?>courselist/" class="btn btn-info btn-raised btn-sm">
        <i class="zmdi zmdi-long-arrow-return"></i> Volver
    </a>
</p>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="zmdi zmdi-refresh"></i> Actualizar datos del curso</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <fieldset>
                            <legend><i class="zmdi zmdi-book"></i> Informaci&oacute;n del curso</legend><br>
                            <input type="hidden" name="id" value="<?php echo $rows['id']; ?>">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Nombre *</label>
                                            <input class="form-control" type="text" name="name" value="<?php echo $rows['Nombre']; ?>" required="" maxlength="100">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Descripción *</label>
                                            <textarea class="form-control" name="description" rows="2" required=""><?php echo $rows['Descripcion']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Profesor *</label>
                                            <select class="form-control" name="codigo_profesor" required="">
                                                <?php
                                                foreach ($teachers as $profesor) {
                                                    $selected = ($profesor['Codigo'] == $rows['Codigo_profesor']) ? 'selected' : '';
                                                    echo '<option value="'.$profesor['Codigo'].'" '.$selected.'>'.$profesor['Nombres'].' '.$profesor['Apellidos'].'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <p class="text-center">
                            <button type="submit" class="btn btn-success btn-raised btn-sm"><i class="zmdi zmdi-refresh"></i> Guardar cambios</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php else: ?>
    <p class="lead text-center">Lo sentimos ocurrió un error inesperado</p>
<?php
        endif;
    else:
        $logout2 = new loginController();
        echo $logout2->login_session_force_destroy_controller(); 
    endif;
?>
