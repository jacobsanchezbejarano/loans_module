-- Insertar datos de prueba en la tabla prestamos
INSERT INTO prestamos (cod_pers, deuda, fecha_inicio, deuda_inicial, sumatoria_pagos, saldo_pendiente, tipo_plan_pagos, monto_cuota, periodo_cuota_numeric, periodo_cuota_medida)
VALUES
    (1, 1000.00, '2023-01-01', 1000.00, 0.00, 1000.00, 'Mensual', 200.00, 1, 'Mes'),
    (2, 2000.00, '2023-02-01', 2000.00, 0.00, 2000.00, 'Quincenal', 150.00, 2, 'Quincena'),
    (3, 1500.00, '2023-03-01', 1500.00, 0.00, 1500.00, 'Semanal', 100.00, 1, 'Semana');

-- Insertar datos de prueba en la tabla pagos
INSERT INTO pagos (prestamo_id, fecha_pago, monto_pagado, tipo_transaccion)
VALUES
    (1, '2023-01-15', 200.00, 'Descuento antes de pago por servicios'),
    (2, '2023-02-10', 150.00, 'Descuento antes de pago por servicios'),
    (3, '2023-03-05', 100.00, 'Descuento antes de pago por servicios'),
    (1, '2023-02-01', 200.00, 'Cobro Directo al Staff'),
    (2, '2023-02-20', 150.00, 'Cobro Directo al Staff'),
    (3, '2023-03-10', 100.00, 'Cobro Directo al Staff');