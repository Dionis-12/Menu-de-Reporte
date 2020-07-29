<?php
// Incluir la Conexión a la BD
include('conexion.php');

$fecha1 = $_POST['fecha1'];
$fecha2 = $_POST['fecha2'];

if (isset($_POST['generar_reporte']))
{
	// NOMBRE DEL ARCHIVO Y CHARSET
	$date = date('dmY');
	$nombre = "liscmp";
	$file = ".txt";
	header('Content-Type:application/vnd.ms-excel; charset=utf-8');
	header('Content-Disposition: attachment; filename=liscmp'." ".$date.$file);

	// SALIDA DEL ARCHIVO
	$salida = fopen('php://output', 'w');

	// Para reflejar acentos en los encabezados
	fprintf($salida, chr(0xEF).chr(0xBB).chr(0xBF));

		// QUERY PARA CREAR EL REPORTE
		$sql = "SELECT
				CAST(Movil1 AS VARCHAR(11))  + cast(',' as varchar(1)) + CAST('0' AS VARCHAR(1)) + cast(',' as varchar(1)) + CAST(Case
				   When canal= 'AA'
				   	Then '''Tu opinion es importante. Ayudanos a valorar la gestion realizada en el Agente Autorizado Movistar ingresa http://bit.ly/2XfmLXk'''
				   When canal= 'ASI'
				   	Then '''Tu opinion es importante.Ayudanos a valorar la gestion realizada en el Agente de Servicio Integral Movistar http://bit.ly/2KMYEs8'''
				   When canal= 'CDS'
				   	Then '''Ayudanos a valorar la gestion realizada en el Centro de Servicio Movistar ingresando en http://bit.ly/2X8zQg0'''
				   When canal= 'CC'
				   	Then '''Tu opinion es importante. Ayudanos a valorar la gestion realizada en el Call Center Movistar ingresando en http://bit.ly/2RGvfAN'''
				   When canal= 'MM'
				   	Then '''Tu opinion es importante. Ayudanos a valorar la gestion realizada en el canal Mi Movistar ingresando en http://bit.ly/2XKtnMV'''
				   When canal ='RRSS'
				   	Then '''Tu opinion es importante. Ayudanos a valorar la gestion realizada en el Canal de Redes Sociales ingresa https://bit.ly/2uKFZa1'''
				   When canal ='CHAT'
				   	Then '''Tu opinion es importante. Ayudanos a valorar la gestion realizada en el Canal de Chat ingresando en https://bit.ly/38noag0'''

	   			else '' end as varchar(131)) as col1
	   			FROM Broadcast_call where Fecha >= '$fecha1' AND Fecha < '$fecha2' + 'INTERVAL 1 DAY' AND canal in ('AA', 'ASI', 'CDS', 'CC', 'MM', 'CHAT','RRSS') 
	   			ORDER BY canal asc";
	   			
		$reporteTxt = sqlsrv_query($con,$sql);
		while ($filaR = sqlsrv_fetch_array($reporteTxt, SQLSRV_FETCH_ASSOC)){
				
								echo $filaR['col1'].PHP_EOL;
								
		}
	}

?>