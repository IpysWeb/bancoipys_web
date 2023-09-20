<?php
if (isset($_POST["submit"]) && $_POST['submit']) {

    (guardar("autor"));
    (guardar("data_web"));
    (guardar("idioma"));
    (guardar("medio"));
    (guardar("pais"));
    (guardar("sobre"));
    (guardar("tema"));
    (guardar("tipo"));

    $fecha = new DateTime();
    $text = '{"version": "' . $fecha->getTimestamp() . '"}';

    $nombre_fichero = "assets/version.json";
    $open = fopen($nombre_fichero, "w+"); //abres el fichero en modo lectura/escritura
    fwrite($open, $text); //escribes el contenido en el fichero
    fclose($open); //cierras el fichero
    echo "<p>El Contenido se Actualizo!</p>";
} else {
    echo "<form action='" . $_SERVER[' PHP_SELF'] . "' method='post'>";
    echo "<input name='submit' type='submit' value='Update' /></form>";
}


function guardar($hoja)
{
    $ruta = "https://script.google.com/macros/s/AKfycbydxsJUHWt90PKNzOBSnpbTU_8M7O_wrbqZ8TYH2ilGeHn0lfpVzjCo0mKR-CU_6EO_/exec?hoja=";
    //pruebas
    //$ruta = "https://script.google.com/macros/s/AKfycbwW84cIZaElypoEmKR8CRiMgtP8j1AOOtR7Oylnzu8/dev";
    $url = $ruta . $hoja;
   
    // Initialize a CURL session.
    $ch = curl_init();
    $header = ['Content-Type: application/json'];

    // Return Page contents.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

    // Grab URL and pass it to the variable
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);


    $nombre_fichero = "assets/json/" . $hoja . ".json";
    $open = fopen($nombre_fichero, "w+"); //abres el fichero en modo lectura/escritura
    fwrite($open, $result); //escribes el contenido en el fichero
    fclose($open); //cierras el fichero

    echo "- " . $hoja . " actualizado<br>";
    return $hoja;
}
