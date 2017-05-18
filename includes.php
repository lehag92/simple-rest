<?php
//Files array
$files = [
    'connection/Config.php',
    'connection/Database.php',
    'rest/controllers/MainController.php',
    'rest/controllers/ResponseController.php',
    'rest/controllers/ListController.php',
    'rest/controllers/AbstractController.php',
    'rest/controllers/GetController.php',
    'rest/controllers/EditController.php',
    'rest/models/ListModel.php',
    'rest/models/GetModel.php',
    'rest/models/EditModel.php',
];
//Include
foreach ($files as $file) {
    require_once ($file);
}
