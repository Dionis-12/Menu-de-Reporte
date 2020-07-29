<?php
// Incluir la Conexión a la BD
include('conexion.php');
?>

<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
		<link href="../Broadcast_Canales/css/estilos.css" rel="stylesheet">
		<link rel="icon" href="../Broadcast_Canales/movistar.ico">
		<title> Descarga de Reportes Call </title>
	</head>

	<body>
	<!-- Imagen de la Página -->
	<div> <img src="../Broadcast_Canales/telefonica.png"> </div>

		<!-- Título Principal de la Página -->
		<header>
			<div>
				<h2> Descarga de Reportes Broadcast Call </h2>
			</div>
		</header>

		<!-- Formato de Fechas a Descargar -->
		<form method="post" class="form" action="reporte.php">
			<input type="date" name="fecha1" style="text-align: center;">
			<input type="date" name="fecha2" style="text-align: center;">
			<input type="submit" name="generar_reporte">
		</form>

		<section>
			<!-- Encabezados de la Tabla -->
			<table class="table">
				<tr>
					<th style="text-align: center;"> Fecha </th>	
					<th style="text-align: center;"> Canal </th>
					<th style="text-align: center;"> Cantidad </th>
				</tr>

				<?php
				while ($row = sqlsrv_fetch_array($res))
				{
					// Se imprime los Resultados
					echo'<tr>
							<td style="text-align: center;" width="50">'.$row['fecha'].'</td>
							<td style="text-align: center;" width="50">'.$row['canal'].'</td>
							<td style="text-align: center;" width="50">'.number_format($row['Cantidad'],0,",",".").'</td>
						 </tr>';
				}
				?>
			</table>
		</section>
	</body>
</html>