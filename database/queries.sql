SELECT
    prestamos.id_prestamo, prestamos.id_hardware, prestamos_estados_prestamo.id_estado_prestamo
FROM prestamos
LEFT JOIN prestamos_estados_prestamo
    ON prestamos.id_prestamo = .prestamos_estados_prestamo.id_prestamo
INNER JOIN estados_prestamo
    ON prestamos_estados_prestamo.id_estado_prestamo = estados_prestamo.id_estado_prestamo
WHERE prestamos_estados_prestamo.created_at IS NULL
    OR prestamos_estados_prestamo.created_at = (
        SELECT MAX(.prestamos_estados_prestamo.created_at)
        FROM prestamos_estados_prestamo
        WHERE prestamos_estados_prestamo.id_prestamo = prestamos.id_prestamo)