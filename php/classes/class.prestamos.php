<?php

include 'class.prestamo.php';

class Prestamos {
    private $prestamos;
    private $conn;


    public function __construct() {
        $this->prestamos = array();
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


    // Método para agregar un préstamo a la colección
    public function agregarPrestamo(Prestamo $prestamo) {
        $this->prestamos[] = $prestamo;
    }

    // Método para obtener todos los préstamos desde la base de datos
    public function obtenerTodosLosPrestamos() {
        try {
            $conn = $this->conectar();
    
            $query = "
                SELECT * FROM prestamos pr
                LEFT JOIN personal pe ON pe.cod_pers = pr.cod_pers 
            ";
    
            $stmt = $conn->prepare($query);
            $stmt->execute();
    
            $prestamos = array();
    
            // Utiliza rowCount para obtener el número de filas
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $prestamo = new Prestamo();
                    $prestamo->setId($row['prestamo_id']);
                    $prestamo->setNombreStaff($row['nom_pers']);
                    $prestamo->setFechaInicio($row['fecha_inicio']);
                    $prestamo->setDeudaInicial($row['deuda_inicial']);
                    $prestamo->setSumatoriaPagos($row['sumatoria_pagos']);
                    $prestamo->setSaldoPendiente($row['saldo_pendiente']);
                    $prestamo->setTipoPlanPagos($row['tipo_plan_pagos']);
    
                    $prestamos[] = $prestamo;
                }
            }
    
            return $prestamos;
        } finally {
            $this->desconectar();
        }
    }

    // Método para obtener información de un préstamo por ID desde la base de datos
    public function obtenerInformacionPrestamo($prestamo_id) {

        try {
            $conn = $this->conectar();
            // Lógica de tu consulta
            $query = "SELECT * FROM prestamos WHERE prestamo_id = $prestamo_id";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                $prestamo = new Prestamo();
                $prestamo->setId($row['prestamo_id']);
                $prestamo->setNombreStaff($row['nombre_staff']);
                $prestamo->setFechaInicio($row['fecha_inicio']);
                $prestamo->setDeudaInicial($row['deuda_inicial']);
                $prestamo->setSumatoriaPagos($row['sumatoria_pagos']);
                $prestamo->setSaldoPendiente($row['saldo_pendiente']);
                $prestamo->setTipoPlanPagos($row['tipo_plan_pagos']);
            }

            return $prestamo;
        } finally {
            $conn->desconectar();
        }
    }

    // Otros métodos según sea necesario
}

?>
