<?php

class Connection {
    private $conn;

    // Método para establecer la conexión
    public function connect() {
        try {
            $this->conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            // Establecer el modo de errores de PDO a excepciones
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            return null;
        }
    }

    // Método para cerrar la conexión
    public function close() {
        $this->conn = null;
    }
}
