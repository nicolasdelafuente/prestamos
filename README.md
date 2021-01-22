# Préstamos

## Hardwares

### Crear hardware **(Administrador)**
* Resgistro nuevo en _hardwares_.
* Registro nuevo en _hardwares_estado_hardwares_.

### Editar hardware **(Administrador)**
* Edita en _hardwares_.
* Si modifica estado
    * Edita _id_estado_hardware_ en _hardwares_
    * Registro nuevo en _hardwares_estado_hardwares_.
* Estado solicitud: Depende de la selección.
___


## Solicitudes

### Crear solicitud **(Usuario)**
* Resgistro nuevo en _solicitudes_.
* Registro nuevo en _solicitudess_estado_solicitudes_.
* Estado solicitud: Pendiente.
* Fecha:
    * No permite _fecha_desde_ anterior al día de hoy.
    * No permite _fecha_hasta_ anterior a _fecha_desde_.
* Obligatorio _motivo_solicitud_ en _solicitudes_.

### Confirmar Solicitud **(Administrador)**
* Aprobar:
    * Estado solicitud: Aprobada.
    * Edita _id_estado_solicitud en _solicitudes_.
    * Registro nuevo en _solicitudes_estados_solicitud_.
    * Se crea préstamo.
* Desaprobar:
    * Estado solicitud: Desaprobada.
    * Edita _id_estado_solicitud en _solicitudes_.
    * Registro nuevo en _solicitudes_estados_solicitud_.
___


## Préstamos

### Crear préstamo **(Administrador)**
* Se crea cuando se aprueba una solicitud.
* Nuevo registro en _prestamos_.
    * Se registra:
        * _id_prestamo_.
        * _id_solicitud_.
        * _created_at_.
        * _updated_at_.
* Nuevo registro en prestamos_estados_prestamos.
* Edita _id_estado_prestamo en _hardwares_.
* Estado prestamo: Pendiente de entrega.

### Aprobar préstamo **(Administrador)**
* Se asgna un hardware listado por numero_serie,
    * Lista
        * Hardwares en estado hardware activo.
        * Hardwares en estado prestamo finalizado o null.
* Nuevo registro en prestamos_estados_prestamos.
* Edita _id_estado_prestamo en _prestamos_.
* Edita _id_estado_prestamo en _hardwares_.
* Estado prestamo: En préstamo.
* Obligatorio _observacion_prestamo_ en _prestamos_.

### Finalizar préstamo, sin problemas **(Administrador)**
* Nuevo registro en prestamos_estados_prestamos.
* Edita _id_estado_prestamo en _prestamos_.
* Edita _id_estado_prestamo en _hardwares_.
* Estado prestamo: Finalizado.
* Obligatorio _observacion_devolucion_ en _prestamos_.

### Finalizar préstamo, con problemas **(Administrador)**
* Nuevo registro en prestamos_estados_prestamos.
* Edita _id_estado_prestamo en _prestamos_.
* Edita _id_estado_prestamo en _hardwares_.
* Estado prestamo: Finalizado, con problemas.
* Obligatorio _observacion_devolucion_ en _prestamos_.

### Finalizar préstamo, con problemas a sin problemas **(Administrador)**
* Nuevo registro en prestamos_estados_prestamos.
* Edita _id_estado_prestamo en _prestamos_.
* Edita _id_estado_prestamo en _hardwares_.
* Estado prestamo: Finalizado,