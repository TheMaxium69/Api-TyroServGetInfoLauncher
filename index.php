<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$info = [
    "latest"=>"launcher-0.1.5",
    "download"=>"http://tyrolium.fr/Download/TyroServS3/launcher/launcher-0.1.5.zip"
];

echo json_encode($info);