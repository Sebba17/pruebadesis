<?php
include "conexion.php";
// obtenemos los datos mediante post
$nombreyapellido = $_POST['nombreyapellido'];
$alias = $_POST['alias'];
$rut = $_POST['rut'];
$email = $_POST['email'];
$region = $_POST['select_region'];
$comuna = $_POST['select_comuna'];
$candidato = $_POST['select_candidato'];
$checkboxes = isset($_POST['checkboxes']) ? implode(",", $_POST['checkboxes']) : "";

// Consultar en la base de datos si existe algún registro de voto realizado con ese RUT
$sql_select = "SELECT COUNT(*) FROM datos WHERE rut = '$rut'";
$result = $mysqli->query($sql_select);
$row = $result->fetch_row();
$count = $row[0];





// Si existe algún registro de voto con ese RUT, significa que el votante ya ha votado y no se permite la duplicación de votos
if ($count > 0) {
    echo '<script>alert("Error. Ya hay un voto registrado con este rut. Por favor intente con otro"); 
    window.location.href = "index.php";</script>';
} else {
    // Insertamos los datos del votante en la base de datos
    $sql_insert = "INSERT INTO datos (rut, nombreyapellido, alias, email, region, comuna, candidatos, observacion) 
    VALUES ('$rut', '$nombreyapellido', '$alias', '$email' , '$region', '$comuna', '$candidato', '$checkboxes' )";
    $result = $mysqli->query($sql_insert);

    if ($result) {
        echo '<script>alert("Felicidades. Su voto ha sido registrado!"); window.location.href = "index.php";</script>';
    } else {
        echo "<script> window.alert('Ocurrió un error al registrar su voto. Por favor, intente de nuevo.'); </script>";
    }
}

?>
