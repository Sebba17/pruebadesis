<?php
	// En este php se obtiene los datos de la tabla comuna de la base de datos
	require ('../conexion.php');
	
	$region_id = $_POST['region_id'];
	
	$queryM = "SELECT comuna_id, nombre FROM comuna WHERE region_id = '$region_id' ORDER BY nombre";
	$resultadoM = $mysqli->query($queryM);
	
	$html= "<option value='0'>Seleccionar Comuna</option>";
	
	while($rowM = $resultadoM->fetch_assoc())
	{
		$html.= "<option value='".$rowM['nombre']."'>".$rowM['nombre']."</option>";
	}
	
	echo $html;
?>		