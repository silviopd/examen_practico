<?php
//    require_once 'sesion.validar.vista.php';
    
    require_once '../util/funciones/definiciones.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo C_NOMBRE_SOFTWARE; ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	
        <?php
	    include 'estilos.vista.php';
	?>

    </head>
    <body class="skin-blue layout-top-nav">
        <!-- Site wrapper -->
        <div class="wrapper">

            <?php
                include 'cabecera.vista.php';
            ?>

            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 class="text-bold text-black" style="font-size: 20px;">Registro de Ventas</h1>
                </section>

		<small>
                    <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <form class="form-inline">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="rbtipo" id="rbtipo" value="1" checked="" >
                                              Solo Hoy
                                            </label>
                                        </div>
                                        &nbsp;&nbsp;
                                        <div class="radio">
                                            <label>
                                              <input type="radio" name="rbtipo" id="rbtipo" value="2">
                                              Rango de Fechas
                                            </label>
                                        </div>
                                        &nbsp;&nbsp;
                                        <div class="radio">
                                            <label>
                                              <input type="radio" name="rbtipo" id="rbtipo" value="3">
                                              Todas las Fechas
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                &nbsp;
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="input-group">
                                            <label>Desde:&nbsp;</label>
                                            <div class="input-group">
                                                <input type="date" id="txtfecha1" class="form-control input-sm" disabled="" value="<?php echo date('Y-m-d'); ?>"/>
                                            </div><!-- /.input group -->
                                        </div><!-- /.form group -->
                                        &nbsp;&nbsp;
                                        <div class="input-group">
                                            <label>Hasta:&nbsp;</label>
                                            <div class="input-group">
                                                <input type="date" id="txtfecha2" class="form-control input-sm" disabled="" value="<?php echo date('Y-m-d'); ?>"/>
                                            </div><!-- /.input group -->
                                        </div><!-- /.form group -->

                                        &nbsp;
                                        <button type="button" class="btn btn-primary btn-sm" id="btnfiltrar">Filtrar datos</button>

                                        &nbsp;
                                        <button type="button" class="btn btn-danger btn-sm" id="btnagregar">Agregar nueva venta</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                    <p>
                        <div class="box box-success">
                            <div class="box-body">
                                <div id="listado">
                                    
                                </div>
                            </div>
                        </div>
                    </p>
                </section>
		</small>
            </div>
            
            <small>
                            <form id="frmgrabar">
                                <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="titulomodal">Detalle Venta</h4>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <p>Cliente<input type="text" name="txtclientemodal" id="txtclientemodal" class="form-control input-sm text-center text-bold" placeholder="" readonly="" style="text-align: left" ></p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <table id="tabla-listado-informacion" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th style="text-align: center; font-size:12px">Numero Linea</th>                                                              
                                                                    <th style="text-align: right; font-size:12px">Numero Recibo</th>
                                                                    <th style="text-align: right; font-size:12px">Fecha Vencimiento</th>
                                                                    <th style="text-align: right; font-size:12px">IMPORTE</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody id="detalleventa-informacion" >

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </small>
            
        </div><!-- ./wrapper -->
	<?php
	    include 'scripts.vista.php';
	?>
	
	<!--JS-->
        <script src="js/pago.listado.js" type="text/javascript"></script>

    </body>
</html>