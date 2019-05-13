<?php
$folder="../";
require_once("../configuracion.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Ronald Franz Nina Layme">
    <meta name="description" content="Sistema de Administración para Red Internacional Empresarial Bolivia - Diseñado por Ronald Nina Layme">
    <meta name="keywords" content="rie,sistema de administración,compra de celulares,">
    <title>RIE</title>
    <link rel="icon" href="<?php echo $folder;?>imagenes/favicon.ico" type="image/x-icon" />
    <link href="<?php echo $folder;?>css/core/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $folder;?>css/core/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo $folder;?>css/core/animate.css" rel="stylesheet">
    <link href="<?php echo $folder;?>css/core/style.css" rel="stylesheet">


</head>

<body class="gray-bg">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <div class="panel" style="margin-bottom:0px !important">
                    <div class="panel-body">

                        <div class="middle-box1 text-center loginscreen animated fadeInDown">
                            <div class="panel" style="margin-bottom:0px !important">
                                <div class="panel-body">
                                    <div>
                                        <img src="../imagenes/logo/logo.png" class="img-thumbnail" alt="">
                                    </div>
                                    <h3 style="line-height:1.6em;"><?=$TituloSistema;?></h3>
                                    <p>
                                    </p>

                                    <div class="row">
                                        <div class="col-lg-5   animated fadeInDown" style="border:#ddd dotted 1px;margin-top:20px;">
                                            <!-- Inicio 1 -->
                                                        <?php if(isset($_GET['noplaca'])){?>
                                                <div class="alert alert-warning">
                                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                    No se encontro el vehiculo Buscado, reviselo e intente nuevamente
                                                </div>
                                                <?php }?>
                                                <?php if(isset($_GET['noci'])){?>
                                                <div class="alert alert-danger">
                                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                    No se encontro el vehiculo o chofer Buscado, reviselo e intente nuevamente
                                                </div>
                                                <?php }?>
                                                <form class="m-t" role="form" action="../revisar/" method="post">
                                                    <input type="hidden" name="u" value="<?php echo isset($_GET['u'])?$_GET['u']:'';?>" />
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Placa"  autofocus name="Placa">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="number" class="form-control" placeholder="Ci"  name="Ci">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary block full-width m-b">Revisar Antecedentes</button>


                                                </form>

                                            <!-- Fin 1 -->
                                        </div>

                                        <div class="col-lg-5 col-lg-offset-2 animated fadeInDown" style="border:#ddd dotted 1px; margin-top:20px">
                                            <!-- Inicio 2 -->
                                                <?php if(isset($_GET['incompleto'])){?>
                                                <div class="alert alert-warning">
                                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                    Los Datos Introducidos se encuentran Incompletos
                                                </div>
                                                <?php }?>
                                                <?php if(isset($_GET['error'])){?>
                                                <div class="alert alert-info">
                                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                    Los Datos Introducidos son erroneos, Verifique y vuelva a Intentarlo
                                                </div>
                                                <?php }?>
                                                <form class="m-t" role="form" action="login.php" method="post">
                                                    <input type="hidden" name="u" value="<?php echo isset($_GET['u'])?$_GET['u']:'';?>" />
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Usuario" required="" autofocus name="usuario">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="password" class="form-control" placeholder="Contraseña" required="" name="pass">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary block full-width m-b">Acceder</button>


                                                </form>
                                            <!-- Fin 2 -->
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12" style="">
                                            <p class="m-t"> <small>Todos los Derechos Reservados &copy; <?=date("Y")!="2019"?'2019':'';?> <?php echo date("Y")?></small> </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>







                    </div>
                </div>
            </div>
        </div>


    </div>



    <!-- Mainly scripts -->
    <script src="<?php echo $folder;?>js/core/jquery-2.1.1.js"></script>
    <script src="<?php echo $folder;?>js/core/bootstrap.min.js"></script>
    <script>
      $(document).ready(function() {
        $("[name=usuario]").focus();
        $("[name=usuario]").keydown(function(event) {
          if(event.which==32){
            event.preventDefault();
          }
          $("[name=usuario]").val(($("[name=usuario]").val()).toLowerCase())
          //alert(event.which);
        });
      });
    </script>
</body>
</html>
