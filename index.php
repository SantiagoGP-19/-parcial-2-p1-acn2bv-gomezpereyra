<?php

include_once("conexion.php");
include_once("funciones.php");

$errors = [];
$success = null;

$db = new Conexion();

$sqlGet = "SELECT Id as id, titulo as title, artista as artist, categoria, descripcion, url as imagen, anio FROM albuns";
$items = $db->consultar($sqlGet);

$q = trim($_GET['q'] ?? '');
$categoriaFilter = trim($_GET['categoria'] ?? '');
$tema = trim($_GET['tema'] ?? 'claro');

$categories = array_values(array_unique(array_map(function ($it) {
    return $it['categoria'];
}, $items)));
sort($categories);

$filtered = array_filter($items, function ($it) use ($q, $categoriaFilter) {
    if ($q !== '' && stripos($it['title'], $q) === false)
        return false;
    if ($categoriaFilter !== '' && strtolower($categoriaFilter) !== 'todas') {
        if (strcasecmp($it['categoria'], $categoriaFilter) !== 0)
            return false;
    }
    return true;
});


$totalItems = count($items);
$resultsCount = count($filtered);

include_once("header.php");
include_once("main.php");
include_once("footer.php");
?>