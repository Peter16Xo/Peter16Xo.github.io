<?php if($_SESSION['userType']=="Administrador"): ?>
<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Cursos <small>(Nuevo)</small></h1>
	</div>
	<p class="lead">
		Bienvenido a la secci&oacute;n de cursos, aqu&iacute; podr&aacute;s registrar nuevos cursos (Los campos marcados con * son obligatorios para registrar un curso).
        </p>
	</p>
</div>
<div class="container-fluid">
	<ul class="breadcrumb breadcrumb-tabs">
	  	<li class="active">
	  	<a href="<?php echo SERVERURL; ?>course/" class="btn btn-info">
	  		<i class="zmdi zmdi-plus"></i> Nuevo
	  	</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL; ?>courselist/" class="btn btn-success">
	  			<i class="zmdi zmdi-format-list-bulleted"></i> Lista
	  		</a>
	  	</li>
	</ul>
</div>
<?php 
    require_once "./controllers/courseController.php";

    $insCourse = new courseController();
    $teachers = $insCourse->get_all_teachers();

    if(isset($_POST['name']) && isset($_POST['description'])){
        echo $insCourse->add_course_controller();
    }
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="zmdi zmdi-plus"></i> Nuevo Curso</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <fieldset>
                            <legend><i class="zmdi zmdi-book"></i> Informaci&oacute;n del curso</legend><br>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Nombre *</label>
                                            <input class="form-control" type="text" name="name" value="<?php if(isset($_POST['name'])){ echo $_POST['name']; } ?>" required="" maxlength="100">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Descripci&oacute;n *</label>
                                            <textarea class="form-control" name="description" rows="2" required=""><?php if(isset($_POST['description'])){ echo $_POST['description']; } ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Profesor *</label>
                                            <select class="form-control" name="codigo_profesor" required="">
                                                <?php
                                                foreach ($teachers as $profesor) {
                                                    echo '<option value="'.$profesor['Codigo'].'">'.$profesor['Nombres'].' '.$profesor['Apellidos'].'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <p class="text-center">
                            <button type="submit" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
else:
    $logout2 = new loginController();
    echo $logout2->login_session_force_destroy_controller(); 
endif;
?>