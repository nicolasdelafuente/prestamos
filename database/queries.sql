SELECT
    hardwares_estados_hardware.id_hardware_estados_hardware,
    hardwares_estados_hardware.id_hardware,
    hardwares_estados_hardware.created_at_hardware_estado_hardware,
    hardwares_estados_hardware.id_estado_hardware
FROM
    hardwares_estados_hardware
INNER JOIN
    ( SELECT id_hardware, MAX(created_at_hardware_estado_hardware) fecha_max
        FROM hardwares_estados_hardware
        GROUP BY id_hardware ) resultado
    ON hardwares_estados_hardware.id_hardware = resultado.id_hardware
        AND hardwares_estados_hardware.created_at_hardware_estado_hardware = resultado.fecha_max
    GROUP BY hardwares_estados_hardware.id_hardware


SELECT
    hardwares_estados_hardware.id_hardware_estados_hardware,
    estados_hardware.estado_hardware,
    hardwares.id_hardware,
    tipos_hardware.tipo_hardware,
    marcas.marca,
    hardwares.modelo,
    hardwares.numero_serie,
    hardwares.codigo_interno,
    hardwares.descripcion_hardware,
    hardwares.created_at_hardware
FROM
    hardwares
INNER JOIN
    tipos_hardware on hardwares.id_tipo_hardware = tipos_hardware.id_tipo_hardware
INNER JOIN
    marcas on hardwares.id_marca = marcas.id_marca
INNER JOIN
    hardwares_estados_hardware ON hardwares.id_hardware = hardwares_estados_hardware.id_hardware
INNER JOIN
    estados_hardware ON hardwares_estados_hardware.id_estado_hardware = estados_hardware.id_estado_hardware    
ORDER BY tipos_hardware.tipo_hardware