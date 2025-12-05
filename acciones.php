<?php
header('Content-Type: application/json');
include_once("conexion.php");
$db = new Conexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'edit') {
        $id         = (int)($_POST['id'] ?? 0);
        $title      = trim($_POST['title'] ?? '');
        $artist     = trim($_POST['artist'] ?? '');
        $categoria  = trim($_POST['categoria'] ?? '');
        $descripcion= trim($_POST['descripcion'] ?? '');
        $imagen     = trim($_POST['imagen'] ?? '');
        $anio       = (int)($_POST['anio'] ?? date('Y'));

        if ($id > 0 && $title !== '' && $categoria !== '' && $descripcion !== '') {
            $sql = "UPDATE albuns SET 
                        titulo = ?, artista = ?, categoria = ?, 
                        descripcion = ?, url = ?, anio = ? 
                    WHERE Id = ?";
            $db->insertar($sql, [$title, $artist, $categoria, $descripcion, $imagen, $anio, $id]);
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Faltan datos obligatorios']);
        }
        exit;
    }
    if ($action === 'delete') {
    $id = (int)($_POST['id'] ?? 0);
    if ($id > 0) {
        $sql = "DELETE FROM albuns WHERE Id = ?";
        $db->pdo->prepare($sql)->execute([$id]);
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'ID inválido']);
    }
    exit;
}
}
?>