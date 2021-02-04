# MVC Pattern

MVC Pattern son las siglas de Model-View-Controller Pattern. Este patrón se usa para separar las preocupaciones de la aplicación.

- _Model_ - El modelo representa un objeto o JAVA POJO que lleva datos. También puede tener lógica para actualizar el controlador si sus datos cambian.

- _View_ - La vista representa la visualización de los datos que contiene el modelo.

- _Controller_ - El controlador actúa tanto en el modelo como en la vista. Controla el flujo de datos hacia el objeto del modelo y actualiza la vista cada vez que cambian los datos. Mantiene la vista y el modelo separados.

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
