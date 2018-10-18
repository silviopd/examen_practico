<?php
//    require_once 'sesion.validar.vista.php';
    
    require_once '../util/funciones/definiciones.php';
    
    //date_default_timezone_set("America/Lima");
    
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
	
	<!-- AutoCompletar-->
	<link href="../util/jquery/jquery.ui.css" rel="stylesheet">

    </head>
    <body class="skin-blue layout-top-nav">
        <!-- Site wrapper -->
        <div class="wrapper">

            <?php
                include 'cabecera.vista.php';
            ?>

	    <form id="frmgrabar">
		<div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 class="text-bold text-black" style="font-size: 20px;">Registrar nueva venta</h1>
                    <ol class="breadcrumb">
                        <button type="button" class="btn btn-danger btn-sm" id="btnregresar">Regresar</button>
			<button type="submit" class="btn btn-primary btn-sm">Registrar la venta</button>
                    </ol>
                </section>
		<small>
		    <section class="content">
                    <div class="box box-pane">
                        <div class="box-body">                              
                              <div class="row">                                  
                                  <div class="col-xs-4">
                                      <div class="form-group">
                                        <label>Código</label>
                                        <input type="text" class="form-control input-sm" id="txtcodigocliente" name="txtcodigocliente" required="">
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-xs-7">
                                      <div class="form-group">
                                        <label>Cliente</label>
                                        <input type="text" class="form-control input-sm" id="txtnombrecliente" required="" readonly="">
                                      </div>
                                  </div>
                                  <div class="col-xs-5">
                                      <div class="form-group">
                                        <label>Dirección</label>
                                        <input type="text" class="form-control input-sm" id="lbldireccioncliente" readonly="">
                                      </div>
                                  </div>
                              </div>
                          <!-- /row -->
                          </div>
                    </div>
                    
                    
                    <div class="box box-pane">
                          <div class="box-body">
                              <div class="row">
                                  <div class="col-xs-2">
                                      <div class="form-group">
                                        <label>Fecha de venta</label>
                                        <input type="date" class="form-control input-sm" id="txtfec" name="txtfec" required="" value="<?php echo date('Y-m-d'); ?>"/>
                                      </div>
                                  </div>
                                  <div class="col-xs-2">
                                      <div class="form-group">
                                        <label>Numero telefonico</label>
                                        <select class="form-control input-sm" id="cbonumero" name="cbonumero" >   </select>
                                      </div>
                                  </div>
                                  <div class="col-xs-4">
                                      <div class="form-group">
                                        <label>Recibo</label>
                                        <input type="hidden" id="txtfecha" />
                                        <select class="form-control input-sm" id="cborecibo" name="cborecibo">
					    </select>
                                      </div>
                                  </div>
                                  <div class="col-xs-1">
                                      <div class="form-group">
                                        <label>importe</label>
                                        <input type="text" class="form-control input-sm" id="txtimporte" name="txtimporte" required="" readonly="">
                                      </div>
                                  </div>
                                  <div class="col-xs-1">
                                      <div class="form-group">
                                        <label>&nbsp;</label>
                                        <br>
                                        <button type="button" class="btn btn-danger btn-sm" id="btnagregar">Agregar</button>
                                      </div>
                                  </div>
                              </div>
                              
                          </div>
                    </div>
                        <div class="box box-pane">
                            <div class="box-body">
                                <div class="row">
                                  <div class="col-xs-12">
                                      <table id="tabla-listado" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>N° RECIBO</th>
                                                <th>FECHA VENCIMIENTO</th>
                                                <th style="text-align: right">IMPORTE PAGADO</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody id="detalleventa" >
                                            
                                        </tbody>                                          
                                        
                                        
                                    </table>
                                  </div>
                              </div>
                            </div>
                        </div>
                    <div class="box box-danger">
                          <div class="box-body">
                              <div class="row">
<!--                                  <div class="col-xs-3">
                                      <div class="input-group">
                                        <span class="input-group-addon">SUB.TOTAL:</span>
                                        <input type="text" class="form-control text-right text-bold" id="txtimportesubtotal" name="txtimportesubtotal" readonly="" style="width: 100px;" />
                                      </div>
                                  </div>
                                  <div class="col-xs-3">
                                      <div class="input-group">
                                        <span class="input-group-addon">IGV:</span>
                                        <input type="text" class="form-control text-right text-bold" id="txtimporteigv" name="txtimporteigv" readonly="" style="width: 100px;"/>
                                      </div>
                                  </div>-->
                                  <div class="col-xs-3">
                                      <div class="input-group">
                                        <span class="input-group-addon">TOTAL PAGADO:</span>
                                        <input type="text" class="form-control text-right text-bold" id="txtimporteneto" name="txtimporteneto" readonly="" style="width: 100px;"/>
                                      </div>
                                  </div>
                              </div>
                          </div>
                    </div>
                    
                </section>
		</small>
            </div>
	    </form>
        </div><!-- ./wrapper -->
	<?php
	    include 'scripts.vista.php';
	?>
	        
	
	<!-- AutoCompletar -->
	<script src="../util/jquery/jquery.ui.autocomplete.js"></script>
	<script src="../util/jquery/jquery.ui.js"></script>
	<script src="js/pago.autocompletar.js" type="text/javascript"></script>
	
	<!--JS-->
	<script src="js/cargar-combos.venta.js" type="text/javascript"></script>
	<script src="js/pago.js" type="text/javascript"></script>
	<!--<script src="js/util.js"></script>-->
        

    </body>
</html>