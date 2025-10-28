<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

// Récupération du paramètre type
$type = isset($_GET['t']) ? $_GET['t'] : '';

if ($type === 'server') {

    $client = json_decode(file_get_contents(__DIR__ . '/data/client.json'), true);
    $lock = json_decode(file_get_contents(__DIR__ . '/data/lock.json'), true);
    $optional = json_decode(file_get_contents(__DIR__ . '/data/optional.json'), true);

    // Fusionne les 3 tableaux
    $json = array_merge($client, $lock, $optional);

} else if ($type === "lock" || $type == "optional" || $type == "client" || $type == "launcher") {

    $json = json_decode(file_get_contents(__DIR__ . '/data/'. $type .'.json'), true);

} else {

    $json = json_decode(file_get_contents(__DIR__ . '/data/loader.json'), true);

}

// Renvoie le tableau
echo json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
exit;
