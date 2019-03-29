<?php

require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;

try {

//obtenemos el archivo .csv
    $tipo = $_FILES['archivo']['type'];

    $tamanio = $_FILES['archivo']['size'];

    $archivotmp = $_FILES['archivo']['tmp_name'];


    $offset = -18000; //UTC -5 horas Bogota, Lima, Quito (3.600s * -5 horas)
    $fechaDia1 = "YmdHis"; //formato fecha
    $fdia1 = gmdate($fechaDia1, time() + $offset);

    //echo $fdia1;

    $directorio = '../recursos/' . $fdia1; //Declaramos un  variable con la ruta donde guardaremos los archivos

    //Validamos si la ruta de destino existe, en caso de no existir la creamos
    if(!file_exists($directorio)){
        mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");
    }
//cargamos el archivo
    $lineas = file($archivotmp);

//inicializamos variable a 0, esto nos ayudará a indicarle que no lea la primera línea
    $i = 0;
    ini_set('max_execution_time', 6000);
//Recorremos el bucle para leer línea por línea
    if ($tipo==="application/vnd.ms-excel") {
        foreach ($lineas as $linea_num => $linea) {
            //echo "entro";
            //abrimos bucle
            /*si es diferente a 0 significa que no se encuentra en la primera línea
            (con los títulos de las columnas) y por lo tanto puede leerla*/
            if ($i != 0) {
                //echo "entro if i";
                //abrimos condición, solo entrará en la condición a partir de la segunda pasada del bucle.
                /* La funcion explode nos ayuda a delimitar los campos, por lo tanto irá
                leyendo hasta que encuentre un ; */
                $datos = explode(";", $linea);

                //Almacenamos los datos que vamos leyendo en una variable
                //usamos la función utf8_encode para leer correctamente los caracteres especiales

                if (isset($datos[0])) {
                    $producto = utf8_encode($datos[0]);
                }
                if (isset($datos[1])) {
                    $codigo = $datos[1];
                }
                if (isset($datos[2])) {
                    $aliado = utf8_encode($datos[2]);
                }

                if (strpos($aliado,"FRISBY") !== false){
                    $logo = "../img/Logo_Frisby.jpg";
                    $terminos = "Las fotografías son imágenes de referencia. Redime este bono en cualquier punto de venta Frisby a nivel nacional.El cliente debe mencionar siempre que el código antes de hacerlo efectivo en el punto de venta.
                    Este bono se hace efectivo únicamente por los valores descritos en el bono. Este código no es redimible en las app , o plataformas de domicilios.com, Rappi o uber. 
                    El cliente deberá presentar el código de forma digital  en el  punto de venta. Este bono no es acumulable con otras promociones y/o descuentos. No es canjeable por dinero en efectivo.
                    La marca Frisby no se hace responsable de la pérdida, hurto o vencimiento de este bono. Es indispensable mencionar y entregar este bono antes de realizar la compra.
                    Producto sujeto a disponibilidad del punto de venta. Es indispensable que el cliente mencione la campaña a la cual hace parte al redención del código.";
                }

                if (strpos($aliado, "KOKORIKO") !== false){
                    $logo = "../img/Logo_Kokoriko.jpg";
                    $terminos = "Redime este bono en cualquier punto de venta kokoriko a nivel nacional, excepto en los puntos ubicados en los aeropuertos a nivel nacional, ni puntos franquiciados. El cliente debe mencionar siempre que el código es de NOMBRE DEL CLIENTE ALIADO CELMEDIA  antes de hacerlo efectivo en el punto de venta. 
                    Este bono se hace efectivo únicamente por los valores descritos en el bono. Este código no es redimible en las app , o plataformas de domicilios.com, rappi o uber. Si el código es redimible por nuestro call center kokoriko, el cliente debe mencionar que está comprando por códigos del NOMBRE DEL CLIENTE ALIADO y deberá asumir el costo del domicilio aparte. 
                    El cliente deberá presentar el código de forma digital en el punto de venta. Este bono no es acumulable con otras promociones y/o descuentos. No es canjeable por dinero en efectivo. La marca Kokoriko no se hace responsable de la pérdida, hurto o vencimiento de este bono.
                    Es indispensable mencionar y entregar este bono antes de realizar la compra. Producto sujeto a disponibilidad del punto de venta. Es indispensable que el cliente mencione la campaña a la cual hace parte al redención del código.
";
                }

                if (strpos($aliado, "MIMOS") !== false){
                    $logo = "../img/Logo_Mimos.jpg";
                    $terminos = "Redime este bono en cualquier punto de venta mimo´s a nivel nacional incluyendo puntos de venta franquiciados, excepto en los puntos ubicados en los aeropuertos. El cliente debe mencionar siempre que el código es de el NOMBRE DEL CLIENTE ALIADO antes de hacerlo efectivo en el pvt. Este bono se hace efectivo únicamente por los valores descritos en el bono. 
                    Este código no es redimible en nuestro call center mimos, ni las app , o plataformas de rappi o uber. El cliente deberá presentar el código de forma digital en el punto de venta. Este bono no es acumulable con otras promociones y/o descuentos. No es canjeable por dinero en efectivo. La marca mimo´s no se hace responsable de la pérdida, hurto o vencimiento de este bono. 
                    Es indispensable mencionar y entregar este bono antes de realizar la compra. Producto sujeto a disponibilidad del punto de venta. Es indispensable que el cliente mencione la campaña a la cual hace parte al redención del código.";
                }

                if (strpos($aliado, "AVENTURA") !== false){
                    $logo = "../img/Logo_MundoAventura.jpg";
                    $terminos = "Horario de atención: Consulta horarios del Parque Temático Mundo Aventura pagina Web www.mundoaventura.com.co, Ubicación: Carrera 71D No. 1 - 14 Bogotá. Una vez redimidos los pasaportes, no podrán ser devueltos a Mundo Aventura para la devolución de su dinero. Por políticas de seguridad aquellas personas que sufran del corazón, presenten yesos, suturas, férulas, mujeres en estado de embarazo y aquellos que estén bajo el efecto de alcohol o sustancias alucinógenos, no podrán ingresar a ninguna atracción mecánica del parque
                    No se permite el Ingreso de alimentos y bebidas. Aplican restricciones de seguridad y estatura para ingreso a las atracciones. Temporada baja: jueves y viernes de 1:00 p.m. a 6:00 p.m. sábados, domingos y festivos de 10:00 a.m. a 6:00 p.m. aplica restricciones por acuerdos comerciales que se puedan presentar a nivel corporativo. Temporada alta: apertura todos los días en horario de lunes a viernes de 12:00 M a 6:00 p.m. sábados, domingo y festivos de 10:00 a.m. a 6:00 p.m. se tienen prevista temporada alta en las siguientes fechas: semana santa del 26 de marzo al 1 de abril de 2018, vacaciones de mitad de año del 13 de junio al 8 de julio de 2018, semana de receso del 8 octubre 15 de octubre de 2018 y temporada fin de año del 21 noviembre de 2018 al 10 de enero de 2019. aplica restricciones por acuerdos comerciales que se puedan presentar a nivel corporativo. 
                    Se permite el ingreso a acompañantes sin costo y sin acceso a las atracciones. La reventa de Pasaportes Mundo Aventura está prohibida y será denunciada ante las autoridades judiciales para que se adelanten los procesos legales correspondientes. Para redimir tu pasaporte en taquilla del parque directamente, presenta el cupón. Podrás comprar un bono por lluvia o para fila express en taquilla. Para redimir tu cupón ingresa por la taquilla ubicada por la Carrera, Parqueaderos, taquilla No. 11 o 12.";
                }

                if (strpos($aliado, "POPSY") !== false){
                    $logo = "../img/Logo_Popsy.jpg";
                    $terminos = "Canjea tu producto y en la factura de tus pedidos encontrarás el código que debes presentar en cualquier establecimiento Popsy y reclama 1 cono de dos bolas de helado Popsy.";
                }

                ob_start();
                include 'mi_template_html_de_pdf.php';
                $html_para_pdf = ob_get_clean();

                $content = '<html>';
                $content .= '<head>';
                $content .= '<style>
                #main-header {
                    width: 100%;
                    left: 0;
                    top: 0;
                    position: absolute;
                }
                
                footer{
                    position: absolute;
                    bottom: 0;
                    width: 100%;
                }
                
                #nompromocion{
                   font-size: 23px;
                   color: #a50034;
                   font-family: Helvetica, Arial, sans-serif;
                   font-weight: bold;
                }
                
                .quemados{
                   font-size: 18px;
                   color: #777;
                   font-family: Helvetica, Arial, sans-serif;
                }
                
                .codigos{
                    font-size: 28px;
                   color: #a50034;
                   font-family: Helvetica, Arial, sans-serif;
                   font-weight: bold;
                   border: 2px solid;
                   border-color: #a50034;
                   border-radius: 5px 5px 5px 5px;
                   width: 350px;
                   padding: 10px;
                   align: center;
                }
                
                .terminos{
                    width: 580px;
                    margin-left: 75px;
                    color: #939393;
                    font-size: 16px;
                    font-weight: lighter;
                }';
                $content .= '</style>';
                $content .= '</head><body>';
                $content .= '<header id="main-header">
        <img src="../img/header_bono-Generico_LG.jpg" style="width: 100%; z-index: 1">
</header>
<footer>
<img src="../img/footer_bono-Generico_LG.jpg" style="width: 100%; z-index: 99">
</footer>
<div style="position: absolute"><img src="../img/background_blanco_bono-Generico_LG.jpg" style="width: 100%; height: 1008px; margin-top: 160px">';
                $content .= '<div style="position: relative; text-align: center; margin-top: -1030px">
<p id="nompromocion">' . $producto . '</p>
<img src="' . $logo . '" style="width: 130px"><br>
<p class="quemados">Redime tu premio, presentando<br>el siguiente código:</p>
<div style="margin-left: 176px; margin-top: -28px"><p class="codigos">' . $codigo . '</p></div>
<p class="quemados">y presentando el siguiente NIT de Alianza<br>Celmedia</p>
<div style="margin-left: 176px; margin-top: -28px"><p class="codigos">830.129.852-5</p></div><br><br>
<p class="terminos"><strong>Términos y condiciones generales de los códigos</strong><br>
' . $aliado . $producto . '<br>
'  . $terminos . '</p>';
                $content .= '</div></div></body></html>';

//echo $content;

                $dompdf = new Dompdf();
                ob_start();
                $dompdf->loadHtml($content);
                $dompdf->setPaper('legal', 'portrait'); // (Opcional) Configurar papel y orientación
                $dompdf->render(); // Generar el PDF desde contenido HTML
                $pdf=$dompdf->output(); // Obtener el PDF generado
//$pdf->stream(); // Enviar el PDF generado al navegador
                file_put_contents($directorio . "/" . $codigo . ".pdf", $pdf);


                //guardamos en base de datos la línea leida
                //cerramos condición
            }

            /*Cuando pase la primera pasada se incrementará nuestro valor y a la siguiente pasada ya
            entraremos en la condición, de esta manera conseguimos que no lea la primera línea.*/
            $i++;
            //cerramos bucle
        }
    }else{
        echo "<script>alert('El archivo debe ser de extension .csv'); window.location.href='../public/cargararchivo.php'</script>";
    }
}catch (Exception $e){
    echo "<script>alert('Algo ha pasado, verifica tu archivo'); window.location.href='../public/cargararchivo.php'</script>";
}

function agregar_zip($dir, $zip){
//verificamos si $dir es un directorio
    if (is_dir($dir)) {
        //abrimos el directorio y lo asignamos a $da
        if ($da = opendir($dir)) {
            //leemos del directorio hasta que termine
            while (($archivo = readdir($da))!== false) {
                //Si dentro del directorio hallamos otro directorio
                //llamamos recursivamente esta función
                //para que verifique dentro del nuevo directorio
                if (is_dir($dir . $archivo) && $archivo!="." && $archivo!=".."){
                    agregar_zip($dir.$archivo . "/", $zip);

                }elseif(is_file($dir.$archivo) && $archivo!="." && $archivo!=".."){
                    //echo "Agregando archivo: $dir$archivo";
               $zip->addFile($dir.$archivo, $dir.$archivo);
           }
        }
      //cerramos el directorio abierto en el momento
      closedir($da);
     }
  }
}

//creamos una instancia de ZipArchive
$zip = new ZipArchive();

//directorio a comprimir
//la barra inclinada al final es importante
//la ruta debe ser relativa no absoluta
$dir = '../recursos/' . $fdia1 . "/";

//ruta donde guardar los archivos zip, ya debe existir
$rutaFinal="../comprimidos/";

$archivoZip = $fdia1 . ".zip";

if($zip->open($archivoZip,ZIPARCHIVE::CREATE)===true) {
    agregar_zip($dir, $zip);
    $zip->close();

    //Muevo el archivo a la ruta definida
    @rename($archivoZip, "$rutaFinal$archivoZip");

    //Hasta aqui el archivo zip ya esta creado


}

//Verificar si el archivo ha sido creado
if (file_exists($rutaFinal.$archivoZip)){
    header("Content-type: application/octet-stream");
    header("Content-disposition: attachment; filename=miarchivo.zip");
    // leemos el archivo creado
    readfile('../comprimidos/' . $archivoZip);
    // Por último eliminamos el archivo temporal creado
    unlink($archivoZip);//Destruye el archivo temporal
    //exit;
}else{
    echo "Error, archivo zip no ha sido creado!!";
}

/*require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;

ob_start();
include 'mi_template_html_de_pdf.php';
$html_para_pdf = ob_get_clean();

$content = '<html>';
$content .= '<head>';
$content .= '<style>
#main-header {
    width: 100%;
    left: 0;
    top: 0;
    position: absolute;
}

footer{
    position: absolute;
    bottom: 0;
    width: 100%;
}

#nompromocion{
   font-size: 23px;
   color: #a50034;
   font-family: Helvetica, Arial, sans-serif;
   font-weight: bold;
}

.quemados{
   font-size: 18px;
   color: #777;
   font-family: Helvetica, Arial, sans-serif;
}

.codigos{
    font-size: 28px;
   color: #a50034;
   font-family: Helvetica, Arial, sans-serif;
   font-weight: bold;
   border: 2px solid;
   border-color: #a50034;
   border-radius: 5px 5px 5px 5px;
   width: 350px;
   padding: 10px;
   align: center;
}

.terminos{
    width: 580px;
    margin-left: 75px;
    color: #939393;
    font-size: 16px;
    font-weight: lighter;
}';
$content .= '</style>';
$content .= '</head><body>';
$content .= '<header id="main-header">
        <img src="../img/header_bono-Generico_LG.jpg" style="width: 100%; z-index: 1">
</header>
<footer>
<img src="../img/footer_bono-Generico_LG.jpg" style="width: 100%; z-index: 99">
</footer>
<div style="position: absolute"><img src="../img/background_blanco_bono-Generico_LG.jpg" style="width: 100%; height: 1008px; margin-top: 160px">';
$content .= '<div style="position: relative; text-align: center; margin-top: -1030px">
<p id="nompromocion">VEN Y DISFRUTA DE UN DELICIOSO MIXER</p>
<img src="../img/Logo_Mimos.jpg" style="width: 130px"><br>
<p class="quemados">Redime tu premio, presentando<br>el siguiente código:</p>
<div style="margin-left: 176px; margin-top: -28px"><p class="codigos">1758461-105517</p></div>
<p class="quemados">y presentando el siguiente NIT de Alianza<br>Celmedia</p>
<div style="margin-left: 176px; margin-top: -28px"><p class="codigos">830.129.852-5</p></div><br><br>
<p class="terminos"><strong>Términos y condiciones generales de los códigos</strong><br>
MIMOS Ven y disfruta un delicioso MIXER<br>
Redime este bono en cualquier punto de venta MIMO’S a nivel nacional, excepto en los puntos ubicados en los aeropuertos a nivel nacional, ni puntos franquiciados. El cliente debe mencionar siempre que el código es de NOMBRE DEL CLIENTE ALIADO antes de hacerlo efectivo en el punto de venta. Este bono se hace efectivo únicamente por los valores descritos en el bono. Este código no es redimible en las app , o plataformas de domicilios.com, rappi o uber.  Si el código es redimible por nuestro call center kokoriko, el cliente debe mencionar que está comprando por códigos del NOMBRE DEL CLIENTE ALIADO y deberá asumir el costo del domicilio aparte. El cliente deberá presentar el código de forma digital en el punto de venta. Este bono no es acumulable con otras promociones y/o descuentos. No es canjeable por dinero en efectivo. La marca Kokoriko no se hace responsable de la pérdida, hurto o vencimiento de este bono. Es indispensable mencionar y entregar este bono antes de realizar la compra. Producto sujeto a disponibilidad del punto de venta. Es indispensable que el cliente mencione la campaña a la cual hace parte a la redención del código.</p>';
$content .= '</div></div></body></html>';

//echo $content;

$dompdf = new Dompdf();
ob_start();
$dompdf->loadHtml($content);
$dompdf->setPaper('legal', 'portrait'); // (Opcional) Configurar papel y orientación
$dompdf->render(); // Generar el PDF desde contenido HTML
$pdf=$dompdf->output(); // Obtener el PDF generado
//$pdf->stream(); // Enviar el PDF generado al navegador
file_put_contents("../prueba/archivos.pdf", $pdf);
//file_put_contents("test.pdf", $pdf);
//echo $pdf;*/

/*require('../dompdf/autoload.inc.php');

$contador = 0;

while($contador<=1) {
    ob_start();

$pdf=new Dompdf();
$pdf->AddPage();
$pdf->SetFont('Arial');
$pdf->load_html('<img src="../fpdf181/tutorial/logo.png"><br><br>You can<br><p align="center">center a line</p>and add a horizontal rule:<br><hr><br>
<br><table style="border-style: solid"><tr><td>Prueba</td><td>Test</td></tr><tr><td>Archivo</td><td>PDF</td></tr></table>');
$pdf->Output('F', '../prueba/test.pdf');

//file_put_contents("../prueba/test7.pdf", $pdf);

    ob_end_flush();
    $contador++;
}*/
?>