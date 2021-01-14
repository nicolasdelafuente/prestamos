SELECT
                hardwares.id_hardware,
                tipos_hardware.tipo_hardware,
                marcas.marca,
                hardwares.modelo,
                hardwares.numero_serie,
                hardwares.codigo_interno,
                hardwares.id_estado_hardware,
                estados_hardware.estado_hardware,
                hardwares.id_estado_prestamo,
                estados_prestamo.estado_prestamo,
                hardwares.descripcion_hardware,
                hardwares.created_at AS created_at_hardware
            FROM
                hardwares
            INNER JOIN
                tipos_hardware ON hardwares.id_tipo_hardware = tipos_hardware.id_tipo_hardware
            INNER JOIN
                marcas ON hardwares.id_marca = marcas.id_marca
            INNER JOIN
                estados_hardware ON hardwares.id_estado_hardware = estados_hardware.id_estado_hardware
            INNER JOIN
                estados_prestamo ON hardwares.id_estado_prestamo = estados_prestamo.id_estado_prestamo
            ORDER BY tipos_hardware.tipo_hardware, hardwares.numero_serie;