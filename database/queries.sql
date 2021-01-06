SELECT
    hardwares.id_hardware,
    tipos_hardware.tipo_hardware,
    marcas.marca,
    hardwares.modelo,
    hardwares.numero_serie,
    hardwares.codigo_interno,
    hardwares.descripcion_hardware,
    hardwares.created_at as created_at_hardware
FROM
    hardwares
INNER JOIN
    tipos_hardware on hardwares.id_tipo_hardware = tipos_hardware.id_tipo_hardware
INNER JOIN
    marcas on hardwares.id_marca = marcas.id_marca

GROUP BY hardwares.id_hardware
ORDER BY hardwares.id_hardware;