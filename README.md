# Módulo de Gestión de Préstamos

Este es un módulo de gestión de préstamos que te permite llevar un registro de los préstamos, realizar operaciones como insertar, actualizar, eliminar y ver información detallada de los préstamos.

## Instalación

1. Clona este repositorio en tu servidor web:

   ```bash
   git clone https://github.com/jacobsanchezbejarano/loans_module.git
   Configura la base de datos editando el archivo config.php con tus credenciales:
   ```


// config.php
define('DB_HOST', 'tu-host');
define('DB_USER', 'tu-usuario');
define('DB_PASS', 'tu-contraseña');
define('DB_NAME', 'tu-nombre-de-base-de-datos');
Abre el módulo en tu navegador web:

http://tu-localhost/ruta-al-modulo/
Uso
Vista de Préstamos:

Accede a la vista de préstamos para ver una lista de todos los préstamos registrados.

Registro de Préstamos:

Utiliza la opción de registro para añadir un nuevo préstamo.

Actualización y Eliminación:

Desde la vista de préstamos, puedes actualizar o eliminar préstamos existentes.

Estructura del Proyecto

index.php: Punto de entrada principal.

classes/: Clases PHP para la lógica de negocio.

functions/: Funciones adicionales y utilidades.

css/: Estilos CSS.

js/: Scripts JavaScript.

config.php: Configuración de la base de datos.

Licencia
Este proyecto está bajo la Licencia MIT - consulta el archivo LICENSE.md para más detalles.

Listado de rutas de carpetas
El número de serie del volumen es FEB8-390D
C:.
├───js
│ └───prestamos_module
├───php
│ ├───ajax
│ ├───classes
│ └───functions
├───sql
└───styles
