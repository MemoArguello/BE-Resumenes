<?php
session_start();
include "../db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "include/script.php"; ?>
    <title>BE Estudio Contable</title>
</head>

<body>
    <?php include "include/nav.php"; ?>
    <section class="dashboard">
        <div class="container">
            <!-- Encabezado -->
            <header class="form-summary">
                <div class="header-left">
                    <a href="#" class="back-link">CLICK AQUÍ<br>PARA VOLVER</a>
                </div>
                <div class="header-center">
                    <h1>DARIO VAZQUEZ - RUC: <span class="highlight">872055 - 0</span></h1>
                    <p>VERIFICADO E INFORMADO AL CLIENTE EN FECHA</p>
                </div>
                <div class="header-right">
                    <p><b>REALIZADO POR: </b>
                        <br>
                        <span class="author"><?php echo htmlspecialchars(strtoupper($_SESSION['Nuser'])); ?></span>
                    </p>
                </div>
            </header>

            <!-- Titulo central -->
            <div class="title-section">
                <p class="title-text">Detalle de documentos registrados en</p>
                <div class="title-icons">
                    <span class="logo">MARANGATU</span>
                    <span class="icon">&#128193;</span>
                    <span class="title-number">Nº 21</span>
                </div>
            </div>

            <!-- Tabla principal -->
            <table class="table-summary">
                <thead>
                    <tr>
                        <th colspan="3">INGRESOS GRAVADOS</th>
                        <th colspan="3">COMPRAS GRAVADAS Y RESUMEN DE DIFERENCIA</th>
                        <th colspan="2">DETALLE DE GASTOS</th>
                    </tr>
                    <tr>
                        <th>MES</th>
                        <th>SALARIOS<br> EBY RUC<br><small>80023076</small></th>
                        <th>OTROS <br> SALARIOS</th>
                        <th>DESCRIPCION</th>
                        <th>FECHA <br> DE CORTE</th>
                        <th>MONTO</th>
                        <th>MES</th>
                        <th>MONTO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>ENERO</td>
                        <td></td>
                        <td></td>
                        <td style="text-align: left;">* Egresos personales y a favor de familiares <br> a cargo realizados en el país a la fecha</td>
                        <td></td>
                        <td></td>
                        <td>ENERO</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>FEBRERO</td>
                        <td></td>
                        <td></td>
                        <td style="text-align: left;">* Comprobantes Electrónicos cargados e <br> imputados a la fecha</td>
                        <td></td>
                        <td></td>
                        <td>FEBRERO</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>MARZO</td>
                        <td></td>
                        <td></td>
                        <td style="text-align: left;">* Egresos y Extractos de IPS a la fecha</td>
                        <td></td>
                        <td></td>
                        <td>MARZO</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>ABRIL</td>
                        <td></td>
                        <td></td>
                        <td style="text-align: left;">* Egreso personal por la adquisicion de un <br> automovil cada 3 años</td>
                        <td></td>
                        <td></td>
                        <td>ABRIL</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>MAYO</td>
                        <td></td>
                        <td></td>
                        <td style="text-align: left;">* VIATICOS A CARGAR</td>
                        <td></td>
                        <td></td>
                        <td>MAYO</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>JUNO</td>
                        <td></td>
                        <td></td>
                        <td class="totals">TOTALES</td>
                        <td></td>
                        <td>0</td>
                        <td>JUNIO</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>JULIO</td>
                        <td></td>
                        <td></td>
                        <td style="text-align: center;" rowspan="2" colspan="3" class="summary-title">RESUMEN EN GENERAL</td>
                        <td>JULIO</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>AGOSTO</td>
                        <td></td>
                        <td></td>
                        <td>AGOSTO</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>SEPTIEMBRE</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>SEPTIEMBRE</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>OCTUBRE</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>OCTUBRE</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>NOVIEMBRE</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>NOVIEMBRE</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>DICIEMBRE</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>DICIEMBRE</td>
                        <td></td>
                    </tr>
                </tbody>
                <tfoot style="align-items: center; text-align: center;">
                    <tr>
                        <td class="totals">TOTALES</td>
                        <td>0</td>
                        <td>0</td>
                        <td class="totals" colspan="2">TOTALES</td>
                        <td>0</td>
                        <td class="totals">TOTALES</td>
                        <td>0</td>
                    </tr>
                </tfoot>
            </table>

            <!-- Observaciones -->
            <div class="observations">
                <p><strong>OBS.</strong></p>
                <input type="text" class="int-obser">
            </div>
        </div>
        <?php include "include/footer.php"; ?>
    </section>
</body>

</html>