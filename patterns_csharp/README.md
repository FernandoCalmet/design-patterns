[![Github][github-shield]][github-url]
[![Kofi][kofi-shield]][kofi-url]
[![LinkedIn][linkedin-shield]][linkedin-url]
[![Khanakat][khanakat-shield]][khanakat-url]

# Patrones de Diseño de Software con CSharp

## Patrones Creacionales

Imagen | Patrón | Puntuación | Descripción
--- | --- | --- | ---
![img-abstract-factory](.assets/img/abstract-factory-mini.png) | [Abstract Factory](./abstract_factory) | ⭐⭐⭐ | Permite producir familias de objetos relacionados sin especificar sus clases concretas.
![img-abstract-factory](.assets/img/builder-mini.png) | [Builder](./builder) | ⭐⭐⭐ | Permite construir objetos complejos paso a paso. Este patrón nos permite producir distintos tipos y representaciones de un objeto empleando el mismo código de construcción.
![img-factory-method](.assets/img/factory-method-mini.png) | [Factory Method](./factory_method) | ⭐⭐⭐ | Proporciona una interfaz para la creación de objetos en una superclase, mientras permite a las subclases alterar el tipo de objetos que se crearán.
![img-prototype](.assets/img/prototype-mini.png) | [Prototype](./prototype) | ⭐⭐ | Permite copiar objetos existentes sin que el código dependa de sus clases.
![img-singleton](.assets/img/singleton-mini.png) | [Singleton](./singleton) | ⭐⭐ | Permite asegurarnos de que una clase tenga una única instancia, a la vez que proporciona un punto de acceso global a dicha instancia.

## Patrones Estructurales

Imagen | Patrón | Puntuación | Descripción
--- | --- | --- | ---
![img-adapter](.assets/img/singleton-mini.png) | [Adapter](./adapter) | ⭐⭐⭐ | Permite la colaboración entre objetos con interfaces incompatibles.
![img-bridge](.assets/img/bridge-mini.png) | [Bridge](./bridge) | ⭐ | Permite dividir una clase grande o un grupo de clases estrechamente relacionadas, en dos jerarquías separadas (abstracción e implementación) que pueden desarrollarse independientemente la una de la otra.
![img-composite](.assets/img/composite-mini.png) | [Composite](./composite) | ⭐⭐ | Permite componer objetos en estructuras de árbol y trabajar con esas estructuras como si fueran objetos individuales.
![img-decorator](.assets/img/decorator-mini.png) | [Decorator](./decorator) | ⭐⭐ | Permite añadir funcionalidades a objetos colocando estos objetos dentro de objetos encapsuladores especiales que contienen estas funcionalidades.
![img-facade](.assets/img/facade-mini.png) | [Facade](./facade) | ⭐⭐ | Proporciona una interfaz simplificada a una biblioteca, un framework o cualquier otro grupo complejo de clases.
![img-flyweight](.assets/img/flyweight-mini.png) | [Flyweight](./flyweight) | ⭐ | Permite mantener más objetos dentro de la cantidad disponible de memoria RAM compartiendo las partes comunes del estado entre varios objetos en lugar de mantener toda la información en cada objeto.
![img-proxy](.assets/img/proxy-mini.png) | [Proxy](./proxy) | ⭐ | Permite proporcionar un sustituto o marcador de posición para otro objeto. Un proxy controla el acceso al objeto original, permitiéndote hacer algo antes o después de que la solicitud llegue al objeto original.

## Patrones de Comportamiento

Imagen | Patrón | Puntuación | Descripción
--- | --- | --- | ---
![img-chain-of-responsibility](.assets/img/chain-of-responsibility-mini.png) | [Chain of Responsibility](./chain_of_responsibility) | ⭐ | Permite pasar solicitudes a lo largo de una cadena de manejadores. Al recibir una solicitud, cada manejador decide si la procesa o si la pasa al siguiente manejador de la cadena.
![img-command](.assets/img/command-mini.png) | [Command](./command) | ⭐⭐⭐ | Convierte una solicitud en un objeto independiente que contiene toda la información sobre la solicitud. Esta transformación te permite parametrizar los métodos con diferentes solicitudes, retrasar o poner en cola la ejecución de una solicitud y soportar operaciones que no se pueden realizar.
![img-iterator](.assets/img/iterator-mini.png) | [Iterator](./iterator) | ⭐⭐⭐ | Permite recorrer elementos de una colección sin exponer su representación subyacente (lista, pila, árbol, etc.).
![img-mediator](.assets/img/mediator-mini.png) | [Mediator](./mediator) | ⭐⭐ | Permite reducir las dependencias caóticas entre objetos. El patrón restringe las comunicaciones directas entre los objetos, forzándolos a colaborar únicamente a través de un objeto mediador
![img-memento](.assets/img/memento-mini.png) | [Memento](./memento) | ⭐⭐ | Permite guardar y restaurar el estado previo de un objeto sin revelar los detalles de su implementación.
![img-observer](.assets/img/observer-mini.png) | [Observer](./observer) | ⭐⭐⭐ | Permite definir un mecanismo de suscripción para notificar a varios objetos sobre cualquier evento que le suceda al objeto que están observando.
![img-state](.assets/img/state-mini.png) | [State](./state) | ⭐⭐⭐ | Permite a un objeto alterar su comportamiento cuando su estado interno cambia. Parece como si el objeto cambiara su clase.
![img-strategy](.assets/img/strategy-mini.png) | [Strategy](./strategy) | ⭐⭐⭐ | Permite definir una familia de algoritmos, colocar cada uno de ellos en una clase separada y hacer sus objetos intercambiables.
![img-template-method](.assets/img/template-method-mini.png) | [Template Method](./template_method) | ⭐⭐ | Define el esqueleto de un algoritmo en la superclase pero permite que las subclases sobrescriban pasos del algoritmo sin cambiar su estructura.
![img-visitor](.assets/img/visitor-mini.png) | [Visitor](./visitor) | ⭐⭐ | Permite separar algoritmos de los objetos sobre los que operan.

> Fuente: Refactoring.Guru

<!--- reference style links --->
[github-shield]: https://img.shields.io/badge/-@fernandocalmet-%23181717?style=flat-square&logo=github
[github-url]: https://github.com/fernandocalmet
[kofi-shield]: https://img.shields.io/badge/-@fernandocalmet-%231DA1F2?style=flat-square&logo=kofi&logoColor=ff5f5f
[kofi-url]: https://ko-fi.com/fernandocalmet
[linkedin-shield]: https://img.shields.io/badge/-fernandocalmet-blue?style=flat-square&logo=Linkedin&logoColor=white&link=https://www.linkedin.com/in/fernandocalmet
[linkedin-url]: https://www.linkedin.com/in/fernandocalmet
[khanakat-shield]: https://img.shields.io/badge/khanakat.com-brightgreen?style=flat-square
[khanakat-url]: https://khanakat.com