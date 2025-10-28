<?php

header('Content-Type: application/json; charset=utf-8');

// Récupération du paramètre type
$type = isset($_GET['t']) ? $_GET['t'] : '';

// Vérification du type
if (!in_array($type, ['lock', 'optional', 'server'])) {
    echo json_encode([
        'error' => 'Type invalide.'
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}


$file = __DIR__ . '/' . $type . '.json';

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
