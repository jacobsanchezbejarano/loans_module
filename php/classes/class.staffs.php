<?php

include 'class.staff.php'; // Asegúrate de incluir la definición de la clase Staff

class Staffs {
    private $staffs;

    public function __construct() {
        $this->staffs = array();
    }

    // Método para agregar un objeto Staff a la colección
    public function agregarStaff(Staff $staff) {
        $this->staffs[] = $staff;
    }

    // Método para obtener todos los objetos Staff
    public function obtenerStaffs() {
        return $this->staffs;
    }

    // Método para cargar staffs desde la base de datos
    public function cargarStaffsDesdeBD() {
        // Establecer la conexión a la base de datos
        $conexion = new Connection();
        $conn = $conexion->connect();

        if ($conn) {
            // Realizar la consulta SQL
            $query = "SELECT cod_pers, name FROM personal";
            $stmt = $conn->prepare($query);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener los resultados
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Construir un objeto Staff con los datos de la consulta
                $staff = new Staff($row['cod_pers'], $row['nom_pers']);

                // Agregar el objeto Staff a la colección
                $this->agregarStaff($staff);
            }

            // Cerrar la conexión
            $conexion->close();
        }
    }

    // Otros métodos según sea necesario
}
