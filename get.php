<?php

header('Content-Type: application/json; charset=utf-8');

// Récupération du paramètre type
$type = isset($_GET['t']) ? $_GET['t'] : '';

// Vérification du type
if (!in_array($type, ['lock', 'optional', 'server', 'client'])) {
    echo json_encode([
        'error' => 'Type invalide.'
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}


$file = __DIR__ . '/' . $type . '.json';

if ($type === 'server') {
    // Charge les 3 fichiers JSON
    $client = json_decode(file_get_contents(__DIR__ . '/client.json'), true);
    $lock = json_decode(file_get_contents(__DIR__ . '/lock.json'), true);
    $optional = json_decode(file_get_contents(__DIR__ . '/optional.json'), true);

    // Fusionne les 3 tableaux
    $json = array_merge($client, $lock, $optional);

    // Renvoie le tableau fusionné
    echo json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}

// Vérifie si le fichier existe
if (!file_exists($file)) {
    echo json_encode([
        'error' => 'Le fichier ' . $type . '.json est introuvable.'
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}

// Lit le contenu du JSON
$content = file_get_contents($file);

// Vérifie que le contenu est bien un JSON valide
$json = json_decode($content, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode([
        'error' => 'Le fichier ' . $type . '.json contient un JSON invalide.'
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}

// Renvoie le contenu du JSON original
echo json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);