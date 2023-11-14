<?php

class Prestamo {
    private $conn;
    private $prestamo_id;
    private $cod_pers;
    private $nombre_staff;
    private $deuda;
    private $fecha_inicio;
    private $deuda_inicial;
    private $sumatoria_pagos;
    private $saldo_pendiente;
    private $tipo_plan_pagos;
    private $monto_cuota;
    private $periodo_cuota_numeric;
    private $periodo_cuota_medida;

    public function __construct() {
        // Realiza la consulta a la base de datos para obtener la información del préstamo
        
    }

    public function conectar() {
        $this->conn = new Connection(); // Asegúrate de tener una clase Connection que maneje la conexión
        return $this->conn->connect();
    }

    public function desconectar() {
        if ($this->conn !== null) {
            $this->conn = null;
        }
    }


    public function cargarDatosPrestamo($prestamo_id) {
        $this->prestamo_id = $prestamo_id;
        $data = $this->obtenerInformacionPrestamoDesdeBD($prestamo_id);

        // Configura las propiedades con los valores obtenidos
        $this->setId($data['prestamo_id']);
        $this->setCodPers($data['cod_pers']);
        $this->setNombreStaff($data['name']);
        $this->setDeuda($data['deuda']);
        $this->setFechaInicio($data['fecha_inicio']);
        $this->setDeudaInicial($data['deuda_inicial']);
        $this->setSumatoriaPagos($data['sumatoria_pagos']);
        $this->setSaldoPendiente($data['saldo_pendiente']);
        $this->setTipoPlanPagos($data['tipo_plan_pagos']);
        $this->setMontoCuota($data['monto_cuota']);
        $this->setPeriodoCuotaNumeric($data['periodo_cuota_numeric']);
        $this->setPeriodoCuotaMedida($data['periodo_cuota_medida']);
    }

    private function obtenerInformacionPrestamoDesdeBD($prestamo_id) {
        $conn = $this->conectar();

        // Evita la inyección de SQL utilizando sentencias preparadas
        $query = "
                SELECT * FROM prestamos pr
                LEFT JOIN personal pe ON pr.cod_pers = pe.cod_pers  
                WHERE prestamo_id = :prestamo_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':prestamo_id', $prestamo_id, PDO::PARAM_INT);
        $stmt->execute();

        $conn = null;

        $conn = $this->desconectar();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

// Método para insertar un nuevo préstamo
public function insertarPrestamo($codPers, $fechaInicio, $deudaInicial, $montoCuota, $tipoPlanPagos) {
    $conn = $this->conectar();
    $sql = "INSERT INTO prestamos (cod_pers, fecha_inicio, deuda, saldo_pendiente, deuda_inicial, monto_cuota, tipo_plan_pagos) 
            VALUES (:codPers, :fechaInicio, :deudaInicial, :deuda, :saldo_pendiente, :montoCuota, :tipoPlanPagos)";
    $stmt = $conn->prepare($sql);
    
    // Vincular los parámetros
    $stmt->bindParam(':codPers', $codPers, PDO::PARAM_INT);
    $stmt->bindParam(':fechaInicio', $fechaInicio, PDO::PARAM_STR);
    $stmt->bindParam(':deudaInicial', $deudaInicial, PDO::PARAM_STR);
    $stmt->bindParam(':deuda', $deudaInicial, PDO::PARAM_STR);
    $stmt->bindParam(':saldo_pendiente', $deudaInicial, PDO::PARAM_STR);
    $stmt->bindParam(':montoCuota', $montoCuota, PDO::PARAM_STR);
    $stmt->bindParam(':tipoPlanPagos', $tipoPlanPagos, PDO::PARAM_STR);
    
    $stmt->execute();
    $idInsertado = $conn->lastInsertId(); // Obtener el ID insertado
    
    $this->desconectar();

    return $idInsertado;
}

    // Método para actualizar un préstamo en la base de datos
    public function actualizarPrestamoEnBD() {
        $conn = $this->conectar();
        
        // SQL para actualizar las variables específicas
        $sql = "UPDATE prestamos SET 
                fecha_inicio = :fechaInicio,
                deuda_inicial = :deudaInicial,
                monto_cuota = :montoCuota,
                tipo_plan_pagos = :tipoPlanPagos
                WHERE prestamo_id = :prestamoId";
        
        $stmt = $conn->prepare($sql);

        $FechaInicio = $this->getFechaInicio();
        $DeudaInicial = $this->getDeudaInicial();
        $MontoCuota = $this->getMontoCuota();
        $TipoPlanPagos = $this->getTipoPlanPagos();
        $Id = $this->getId();
        
        // Vincular los parámetros
        $stmt->bindParam(':fechaInicio', $FechaInicio, PDO::PARAM_STR);
        $stmt->bindParam(':deudaInicial', $DeudaInicial, PDO::PARAM_STR);
        $stmt->bindParam(':montoCuota', $MontoCuota, PDO::PARAM_STR);
        $stmt->bindParam(':tipoPlanPagos', $TipoPlanPagos, PDO::PARAM_STR);
        $stmt->bindParam(':prestamoId', $Id, PDO::PARAM_INT);

        $stmt->execute();
        
        $this->desconectar();
    }

    // Método para eliminar un préstamo
    public function eliminarPrestamo($idPrestamo) {
        $sql = "DELETE FROM prestamos WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idPrestamo);
        $stmt->execute();
        $stmt->close();
    }

    // Método para actualizar un préstamo
    public function actualizarPrestamo($idPrestamo, $deudaInicial, $montoCuota, $tipoPlanPagos) {
        $sql = "UPDATE prestamos SET deuda_inicial = ?, monto_cuota = ?, tipo_plan_pagos = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ddsi", $deudaInicial, $montoCuota, $tipoPlanPagos, $idPrestamo);
        $stmt->execute();
        $stmt->close();
    }

    // Métodos de set
    public function setId($prestamo_id) {
        $this->prestamo_id = $prestamo_id;
    }

    public function setCodPers($cod_pers) {
        $this->cod_pers = $cod_pers;
    }

    public function setNombreStaff($nombre_staff) {
        $this->nombre_staff = $nombre_staff;
    }

    public function getNombreStaff() {
        return $this->nombre_staff;
    }

    public function setDeuda($deuda) {
        $this->deuda = $deuda;
    }

    public function setFechaInicio($fecha_inicio) {
        $this->fecha_inicio = $fecha_inicio;
    }

    public function setDeudaInicial($deuda_inicial) {
        $this->deuda_inicial = $deuda_inicial;
    }

    public function setSumatoriaPagos($sumatoria_pagos) {
        $this->sumatoria_pagos = $sumatoria_pagos;
    }

    public function setSaldoPendiente($saldo_pendiente) {
        $this->saldo_pendiente = $saldo_pendiente;
    }

    public function setTipoPlanPagos($tipo_plan_pagos) {
        $this->tipo_plan_pagos = $tipo_plan_pagos;
    }

    public function setMontoCuota($monto_cuota) {
        $this->monto_cuota = $monto_cuota;
    }

    public function setPeriodoCuotaNumeric($periodo_cuota_numeric) {
        $this->periodo_cuota_numeric = $periodo_cuota_numeric;
    }

    public function setPeriodoCuotaMedida($periodo_cuota_medida) {
        $this->periodo_cuota_medida = $periodo_cuota_medida;
    }

    // Métodos de get (puedes agregar más según sea necesario)
    public function getId() {
        return $this->prestamo_id;
    }

    public function getCodPers() {
        return $this->cod_pers;
    }

    public function getDeuda() {
        return $this->deuda;
    }
    
    public function getFechaInicio() {
        return $this->fecha_inicio;
    }
    
    public function getDeudaInicial() {
        return $this->deuda_inicial;
    }
    
    public function getSumatoriaPagos() {
        return $this->sumatoria_pagos;
    }
    
    public function getSaldoPendiente() {
        return $this->saldo_pendiente;
    }
    
    public function getTipoPlanPagos() {
        return $this->tipo_plan_pagos;
    }
    
    public function getMontoCuota() {
        return $this->monto_cuota;
    }
    
    public function getPeriodoCuotaNumeric() {
        return $this->periodo_cuota_numeric;
    }
    
    public function getPeriodoCuotaMedida() {
        return $this->periodo_cuota_medida;
    }

    // Otros métodos según sea necesario
}
