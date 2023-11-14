<?php

include 'class.pago.php';

class Pagos {
    private $pagos;
    private $prestamo_id;

    public function __construct() {
        $this->pagos = array();
    }

    // Método para agregar un pago a la colección
    public function agregarPago(Pago $pago) {
        $this->pagos[] = $pago;
    }

    // Método para obtener todos los pagos
    public function obtenerPagos() {
        return $this->pagos;
    }

    public function cargarPagosPorPrestamo($prestamo_id) {
        $this->prestamo_id = $prestamo_id;
        // Verifica que tengas el ID del préstamo antes de intentar cargar los pagos
        if (empty($this->prestamo_id)) {
            return false; // O maneja el error de alguna manera
        }

        // Utiliza tu lógica de consulta aquí, la siguiente es un ejemplo simplificado
        $connection = new Connection();
        $conn = $connection->connect();

        // Evita la inyección de SQL utilizando sentencias preparadas
        $stmt = $conn->prepare("SELECT * FROM pagos WHERE prestamo_id = :prestamo_id");
        $stmt->bindParam(':prestamo_id', $this->prestamo_id, PDO::PARAM_INT);
        $stmt->execute();

        // Procesa los resultados y crea objetos Pago
        $pagos = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pago = new Pago(
                $row['prestamo_id'],
                $row['fecha_pago'],
                $row['monto_pagado'],
                $row['tipo_transaccion'],
                $row['cod_master']
            );

            $pagos[] = $pago;
        }

        // Configura la propiedad de pagos en el préstamo
        $this->pagos = $pagos;

        return true;
    }

    // Método para obtener los pagos de un determinado préstamo
    public function obtenerPagosPorPrestamo() {
        return $this->pagos;
    }

    // Otros métodos según sea necesario
}

?>

