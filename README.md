# Consultar registro único empresarial y social -RUES-

Paquete para consultas en la pagina de RUES Colombia con Laravel 6 o superior

## Requerimientos

* Se requiere PHP 7.1 o superior.

## Instalación

Agregar `miguelgarces`/`consultas-rues` como una dependencia requerida en su archivo `composer.json`:

    composer require miguelgarces/consultas-rues

## Uso

### Consulta por NIT

Para consultar RUES por nit solo es necesario utilizar el facade: `ConsultaRuesNit`

    use ConsultaRuesNit;
    $respuesta = ConsultaRuesNit::consultar(123456789);

### Consulta por Nombre

Para consultar RUES por nombre solo es necesario utilizar el facade: `ConsultaRuesNombre`

    use ConsultaRuesNombre;
    $respuesta = ConsultaRuesNombre::consultar('Nombre de empresa');



