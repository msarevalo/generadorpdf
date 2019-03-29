<!DOCTYPE html>
<html>
<head>
    <title>Horarios | El Bosque Te LLeva</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="application-name" content="Sistema de Reservas Universidad del Bosque">
    <meta name="author" content="Manuel Arevalo - Lina Avila - Diego Vargas - Juan VIllamil">
    <meta name="description" content="Proyecto De Grado">
    <!-- Estilos -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/horarios.css" rel="stylesheet">
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="application/javascript" src="../js/index.js"></script>
    <script type="application/javascript" src="../js/horarios.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="../img/icon-small.png">

    <style>
        #map {
            height: 400px;
            width: 80%;
            margin-left: 10%;
        }
    </style>
</head>
<body>
<form action="generar.php" enctype="multipart/form-data" method="post" id="crear" style="padding: 30px">
    <!--<input id="archivo" accept=".csv" name="archivo" type="file" required/><br><br><br>-->
    <label class="file" title="">
        <input id="archivo" accept=".csv" name="archivo" type="file" onchange="this.parentNode.setAttribute('title', this.value.replace(/^.*[\\/]/, ''))" required/>
    </label><br><br><br>
    <input name="enviar" type="submit" value="Importar" id="btnHorario"/><br>
</form>
</body>