<?php
//Establecemos conexion con la base de datos
require('conexion.php');
//hacemos una seleccion de datos
$query = "SELECT region_id, nombre FROM region ORDER BY nombre";
$resultado = $mysqli->query($query);

$query1 = "SELECT nombre FROM candidatos ORDER BY nombre";
$resultado1 = $mysqli->query($query1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <title>Sistema de votacion</title>
    <style>
        label {
            width: 150px;
            display: inline-block;
            margin-top: 6px;
            margin-left: 3px;
        }

        /*Modificamos la etiqueta label a nuestro gusto*/
        select {
            width: 170px;
            padding: 2px;
            position: absolute;
            left: 158px;
            margin-top: 5px;
            margin-left: 3.5px;
            border-radius: 5px;
        }

        /*modificamos la etiqueta select a nuestro gusto */
        .vertical-line {
            border-left: 1px solid black;
            height: 280px;
            /*altura de la línea vertical según sea necesario */
        }
    </style>

</head>

<body>
    <b style="font-size:150%">FORMULARIO DE VOTACION:</b><br>
    <br>
    <br>
    <div class="vertical-line">
        <hr style="margin-left:0; width:40%;">


        <!-- Aqui se realiza el formulario con sus respectivos datos y necesidades-->
        <form onsubmit="return validarFormulario()" action="subir.php" method="POST" enctype="multipart/form-data">
            <label> Nombre y Apellido </label><input type="text" name="nombreyapellido" required> <br>
            <label> Alias </label><input type="text" name="alias" required pattern="(?=.*\d)(?=.*[a-zA-Z]).{6,}" title="Debe contener al menos 6 caracteres, incluyendo al menos una letra y un número."> <br>
            <label> RUT </label><input type="text" name="rut" id="rut" required>
            <script src="js/rut.js"></script> <br>
            <label> Email </label><input type="email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Ingrese una dirección de correo electrónico válida"> <br>
            <label style="margin-top: 9px;"> Región </label>
            <select required name="select_region" id="select_region">
                <option value="0">Seleccionar Estado</option>
                <?php while ($row = $resultado->fetch_assoc()) { ?>
                    <option value="<?php echo $row['region_id']; ?>"><?php echo $row['nombre']; ?></option>
                <?php } ?>
            </select> <br>
            <label style="margin-top: 9px;"> Comuna </label>
            <select required name="select_comuna" id="select_comuna"></select> <br>
            <label> Candidato </label>
            <select required name="select_candidato" id="select_candidato">
            <option value="0">Seleccionar Candidato</option>
                <?php while ($row = $resultado1->fetch_assoc()) { ?>
                    <option value="<?php echo $row['nombre']; ?>"><?php echo $row['nombre']; ?></option>
                <?php } ?>
            </select>


            <p style="margin-left: 3.5px;">Como se enteró de Nosotros
                <input type="checkbox" id="checkbox1" name="checkboxes[]" value="web"> Web
                <input type="checkbox" id="checkbox2" name="checkboxes[]" value="tv"> TV
                <input type="checkbox" id="checkbox3" name="checkboxes[]" value="redes sociales"> Redes sociales
                <input type="checkbox" id="checkbox4" name="checkboxes[]" value="amigo"> Amigo
                <span id="errorcheckbox" style="color: red; display: none;">Debe seleccionar al menos dos opciones.</span>
            </p>
            <p style="margin-left: 3.5px;">
                <input type="submit" value="Votar">
            </p>


        </form>
<!-- Termino del formulario -->


    </div>

    <script>
        /*Aqui llamamos a la funcion para validar el rut, y se nos muestre una alerta */
        function validarFormulario() {
            var rut = document.getElementById("rut").value;

            if (!validarRUT(rut)) {
                alert("El RUT ingresado no es válido.");
                return false;
            }

            return true;
        }
    </script>

    <script language="javascript">

/* Aqui actualizamos dinámicamente el contenido de un select dependiendo del valor seleccionado en otro select*/

        $(document).ready(function() {
            $("#select_region").change(function() {

                $("#select_region option:selected").each(function() {
                    region_id = $(this).val();
                    $.post("includes/getcomuna.php", {
                        region_id: region_id
                    }, function(data) {
                        $("#select_comuna").html(data);
                    });
                });
            })
        });
    </script>



    <script src="js/rut.js"></script>
    <script src="js/checkbox.js"></script>

</body>

</html>