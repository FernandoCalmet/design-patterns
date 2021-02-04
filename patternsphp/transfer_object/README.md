# Data Transfer Object Pattern

El patrón Transferir objeto se utiliza cuando queremos pasar datos con múltiples atributos en una sola toma de cliente a servidor. El objeto de transferencia también se conoce como objeto de valor. Transfer Object es una clase POJO simple que tiene métodos getter / setter y es serializable para que pueda transferirse a través de la red. No tiene ningún comportamiento. La clase de negocio del lado del servidor normalmente obtiene datos de la base de datos y llena el POJO y lo envía al cliente o lo pasa por valor. Para el cliente, el objeto de transferencia es de solo lectura. El cliente puede crear su propio objeto de transferencia y pasarlo al servidor para actualizar los valores en la base de datos de una sola vez. A continuación se muestran las entidades de este tipo de patrón de diseño.

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
