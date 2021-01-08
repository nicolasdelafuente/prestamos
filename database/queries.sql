SELECT
                hardwares.id_hardware, hardwares.numero_serie
            FROM hardwares
            LEFT JOIN hardwares_estados_hardware ON hardwares.id_hardware = hardwares_estados_hardware.id_hardware
            INNER JOIN estados_hardware on hardwares_estados_hardware.id_estado_hardware = estados_hardware.id_estado_hardware
            WHERE hardwares_estados_hardware.created_at IS NULL
                OR hardwares_estados_hardware.created_at = (
                    SELECT MAX(hardwares_estados_hardware.created_at)
                    FROM hardwares_estados_hardware
                    WHERE hardwares_estados_hardware.id_hardware = hardwares.id_hardware)
            AND estados_hardware.id_estado_hardware = 1
            AND hardwares.id_tipo_hardware = 5
            ORDER BY hardwares.numero_serie;
