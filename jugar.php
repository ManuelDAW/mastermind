<?php
require 'funciones.php';

session_start();

$colores = ['Azul', 'Rojo', 'Naranja',
    'Verde', 'Violeta', 'Amarillo',
    'Marrón', 'Rosa'];


//Inicializo variables generales
$fomulario = mostrar_formulario($colores);

//Leemos / generamos la clave
if (isset($_SESSION['clave']))
    $clave = $_SESSION['clave'];
else {
    $clave = genera_clave($colores);
    $_SESSION['clave'] = $clave;
}



/**
 * Si he dado a visualizar la clave
 * La visualizo, también cambiamos el texto
 * que visualizará el botón
 */
if (($_POST['clave']) == "Mostrar Clave") {
    $msj.="<h3>CLAVE ACTUAL:<br />" . mostrar_clave($clave) . "</h4>";
    $opciones_juego = "Ocultar Clave";
} else
    $opciones_juego = "Mostrar Clave";


/* AHORA VAMOS A JUGAR* /
 *
 *
 */
if (isset($_POST['jugar'])) {

    //Leo jugada y la evaluamos
    $jugada = leer_jugada();
    $rtdo = compara_jugada($jugada, $clave);

    //Agregamos en variable de sesión la información
    $_SESSION['jugadas'][] = $jugada;
    $_SESSION['resultados'][] = $rtdo;

    //Pongo informaicón de la jugada actual
    $num_jugada = sizeof($_SESSION['jugaas']);
    $col = $rtdo['col'];
    $pos = $rtdo['pos'];
    $msj .= "<h3 class='titulo'>Información de las jugadas </h3>";
    $msj .= "<h3>Jugada actual $num_jugada </h3>";
    $msj .= "<h3>Resultado : $col Colores y $pos posiciones </h3>";


    //Agragamos el histórico de jugadas
    $msj.=mostrar_resultados();


}
?>












<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="estilo.css" type="text/css"/>
        <script type="text/javascript">
            function cambia_color(numero) {
                var color = document.getElementById("combinacion" + numero).value;
                var elemento = document.getElementById("combinacion" + numero);
                elemento.className = color;
            }


        </script>
    </head>
    <body>
        <fieldset id="opciones" >
            <legend>Opciones de juego</legend>
            <form action="jugar.php" method="POST">
                <input type="submit" value="<?php echo $opciones_juego
?>" name="clave" />
            </form>

        </fieldset>
        <fieldset id="informacion">
            <legend>Información de jugadas</legend>
            <?php echo $msj ?>
        </fieldset>>

        <fieldset id="jugadas">
            <legend>Juega</legend>
            <?php echo $fomulario ?>
        </fieldset>

    </body>

</body>
</html>
