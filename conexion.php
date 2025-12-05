<?php
class Conexion {
    private $host = "localhost";
    private $db = "phpweb2";
    private $user = "root";
    private $password = "";
    private $charset = "utf8mb4";
    public $pdo;

    public function __construct() {
        try {
            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $this->pdo = new PDO($connection, $this->user, $this->password, $options);
        } catch (PDOException $e) {
            print_r('Error connection: ' . $e->getMessage());
            die();
        }
    }

    public function insertar($sql, $params = []) {
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($params);
    return $this->pdo->lastInsertId();
}

    public function consultar($sql) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ejecutar($sql) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }

}
?>