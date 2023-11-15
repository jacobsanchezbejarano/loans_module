<?php

class Pago {
    private $conn;
    private $pago_id;
    private $prestamo_id;
    private $fecha_pago;
    private $monto_pagado;
    private $tipo_transaccion;
    private $cod_master;

    // Constructor
    public function __construct($prestamo_id, $fecha_pago, $monto_pagado, $tipo_transaccion, $cod_master) {
        $this->prestamo_id = $prestamo_id;
        $this->fecha_pago = $fecha_pago;
        $this->monto_pagado = $monto_pagado;
        $this->tipo_transaccion = $tipo_transaccion;
        $this->cod_master = $cod_master;
    }

    public function conectar() {
        $this->conn = new Connection();
        return $this->conn->connect();
    }

    public function desconectar() {
        if ($this->conn !== null) {
            $this->conn = null;
        }
    }

    // Método para insertar pago en la base de datos
    public function insertarPago() {
        try {
            $conn = $this->conectar();
            
            $conn->beginTransaction(); // Inicia una transacción
        
            // Inserta un pago en la tabla 'pagos'
            $sqlPago = "INSERT INTO pagos (prestamo_id, fecha_pago, monto_pagado, tipo_transaccion) VALUES (?, ?, ?, ?)";
            $stmtPago = $conn->prepare($sqlPago);
            $stmtPago->bindParam(1, $this->prestamo_id, PDO::PARAM_INT);
            $stmtPago->bindParam(2, $this->fecha_pago, PDO::PARAM_STR);
            $stmtPago->bindParam(3, $this->monto_pagado, PDO::PARAM_STR);
            $stmtPago->bindParam(4, $this->tipo_transaccion, PDO::PARAM_STR);
            $stmtPago->execute();
        
            // Obtén el ID del pago insertado si es necesario
            $idPagoInsertado = $conn->lastInsertId();
        
            // Confirma la transacción
            $conn->commit();
        
            return true; // o podrías devolver $idPagoInsertado y $idPrestamoInsertado si es necesario
        
        } catch (Exception $e) {
            // Maneja los errores según sea necesario
            $conn->rollBack(); // Revierte la transacción en caso de error
            return false;
        } finally {
            $this->desconectar();
        }
    }

    // Métodos de set
    public function setPagoId($pago_id) {
        $this->pago_id = $pago_id;
    }

    public function setPrestamoId($prestamo_id) {
        $this->prestamo_id = $prestamo_id;
    }

    public function setFechaPago($fecha_pago) {
        $this->fecha_pago = $fecha_pago;
    }

    public function setMontoPagado($monto_pagado) {
        $this->monto_pagado = $monto_pagado;
    }

    public function setTipoTransaccion($tipo_transaccion) {
        $this->tipo_transaccion = $tipo_transaccion;
    }

    public function setCodMaster($cod_master) {
        $this->cod_master = $cod_master;
    }

    // Métodos de get
    public function getPagoId() {
        return $this->pago_id;
    }

    public function getPrestamoId() {
        return $this->prestamo_id;
    }

    public function getFechaPago() {
        return $this->fecha_pago;
    }

    public function getMontoPagado() {
        return $this->monto_pagado;
    }

    public function getTipoTransaccion() {
        return $this->tipo_transaccion;
    }

    public function getCodMaster() {
        return $this->cod_master;
    }

    // Otros métodos según sea necesario
}