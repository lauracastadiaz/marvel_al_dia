<?php
// PROYECTO DE PRUEBA
// Nos va a decir la próxima película de Marvel que se estrene a través de una API
// url de la api:  https://whenisthenextmcufilm.com/api

const API_URL = "https://whenisthenextmcufilm.com/api";

# Inicializamos la sesión de cURL; ch= cURL handle
$ch = curl_init(API_URL);

# Indicar que queremos recibir el resultado de la petición y no mostrarla en pantalla
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

# Ejecutar la petición y guardamos el resultado
$result = curl_exec($ch);

// una alternativa a curl sería utilizar file_get_contents
// $result = file_get_contents(API_URL); // si solo quieres hacer un GET de una API

# Decodificamos el JSON
$data = json_decode($result, true);

# Cerramos conexión
curl_close($ch);

# Mostramos la información
// var_dump($data);

?>

<head>
    <title>Marvel al día</title>
    <meta charset="UTF-8">
    <meta name="description" content="Próxima película de Marvel">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css" />
</head>

<main class="container">

    <section>
        <h1>Próximas Películas y Series del Universo Marvel</h1>
        <br> <br>
        <details>
            <summary role="button" class="secondary"><?= $data["title"]?> (<?=$data["type"]?>)</summary>
            <img src="<?= $data["poster_url"]; ?>" width="200" alt="Poster de <?= $data["title"]; ?>" style="border-radius: 16px">
            <h2>Se estrena en <?= $data["days_until"]; ?> días</h2>
            <p><i><?= $data["overview"] ?></i></p>
            <p>Fecha de estreno: <?= $data["release_date"] ?></p>
        </details>

        <details>   
            <summary role="button" class="secondary"><?= $data["following_production"]["title"] ?> (<?=$data["following_production"]["type"]?>)</summary>
            <img src="<?= $data["following_production"]["poster_url"] ?>" width="200" alt="Poster de <?= $data["following_production"]["title"]; ?>" style="border-radius: 16px">
            <h2>Se estrena en <?= $data["following_production"]["days_until"]; ?> días</h2>
            <p><i><?= $data["following_production"]["overview"] ?></i></p>
            <p>Fecha de estreno: <?= $data["following_production"]["release_date"] ?></p>
        </details>
    </section>

</main>