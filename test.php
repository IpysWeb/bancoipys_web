<?php
print_r(guardar("autor"));
print_r(guardar("data_web"));
print_r(guardar("idioma"));
print_r(guardar("medio"));
print_r(guardar("pais"));
print_r(guardar("sobre"));
print_r(guardar("tema"));
print_r(guardar("tipo"));

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

    echo $result;
    return $hoja;
}
