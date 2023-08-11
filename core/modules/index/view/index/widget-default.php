<?php
date_default_timezone_set("America/Bogota");
UserData::verificaSession();
if (!session_id()) session_start();
$fechahoy = date("Y-m-d H:m:s");
//****************************** INDEX ******************************


?>

<div class="row">

    <div class="col-sm-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-book"></i>&nbsp;&nbsp;Bienvenidos al sistema
                </h3>
                <div class="card-tools">

                </div>
            </div>
            <div class="card-body">


            <h1> BIENVENIDO <?php echo $_SESSION['USER_PERFIL']; ?></h1>
<?php echo $_SESSION['USER_NOMBRE']; ?>

                <hr>
                <?php echo $fechahoy;?>


            </div>
        </div>

    </div>

</div>