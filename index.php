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
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"/>
</head>

<main>
    
    <section>
        <img src="<?= $data["poster_url"]; ?>" width="200" alt="Poster de <?= $data["title"]; ?>" style="border-radius: 16px">
    </section>

    <hgroup>
        <h2><u><?= $data["title"]?></u></h2>
        <h2>se estrena en <?= $data["days_until"]; ?> días</h2>
        <p>Fecha de estreno: <?= $data["release_date"]?></p>
        <br>
        <p>La siguiente es: <u><?=$data["following_production"]["title"] ?></u> el <?=$data["following_production"]["release_date"]?> </p>
    </hgroup>
</main>

<style>

    body{
        display: grid;
        place-content: center;
        background-color: #6D2323;
    }

    section{
        display: flex;
        justify-content: center;
        text-align: center;;
    }

    hgroup{
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }

    img{
        margin: 0;
    }

</style>