SELECT
    hardwares_estados_hardware.id_hardware_estado_hardware,
    hardwares_estados_hardware.id_hardware,
    hardwares_estados_hardware.created_at,
    hardwares_estados_hardware.id_estado_hardware
FROM
    hardwares_estados_hardware
INNER JOIN
    ( SELECT id_hardware, MAX(created_at) fecha_max
        FROM hardwares_estados_hardware
        GROUP BY id_hardware ) resultado
    ON hardwares_estados_hardware.id_hardware = resultado.id_hardware
        AND hardwares_estados_hardware.created_at = resultado.fecha_max
GROUP BY hardwares_estados_hardware.id_hardware
ORDER BY hardwares_estados_hardware.id_hardware