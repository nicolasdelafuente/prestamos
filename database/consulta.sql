SELECT
    prestamos.id_prestamo,
    prestamos.id_solicitud,
    tipos_hardware.tipo_hardware,
    usuarios.nombre,
    usuarios.apellido,
    usuarios.email,
    edificios.edificio,
    solicitudes.fecha_desde,
    solicitudes.fecha_hasta,
    prestamos.id_estado_prestamo
FROM
    prestamos
INNER JOIN
    solicitudes ON prestamos.id_solicitud = solicitudes.id_solicitud
INNER JOIN
    tipos_hardware ON solicitudes.id_tipo_hardware = tipos_hardware.id_tipo_hardware
INNER JOIN
    usuarios ON solicitudes.id_usuario  = usuarios.id_usuario
INNER JOIN
    edificios ON solicitudes.id_edificio = edificios.id_edificio            
ORDER BY solicitudes.fecha_desde