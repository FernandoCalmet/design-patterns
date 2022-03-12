# Chain of Responsability Pattern

Como sugiere el nombre, el patrón de cadena de responsabilidad crea una cadena de objetos receptores para una solicitud. Este patrón desacopla al remitente y al receptor de una solicitud según el tipo de solicitud. Este patrón viene bajo patrones de comportamiento.

En este patrón, normalmente cada receptor contiene una referencia a otro receptor. Si un objeto no puede manejar la solicitud, pasa la misma al siguiente receptor y así sucesivamente.

## Ejemplos

- [Example 1](./example1)

## Comandos

```bash
# Generar/Actualizar paquete Vendor para las autocargas
composer dump-autoload
```

---
:octocat: [My Github](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
