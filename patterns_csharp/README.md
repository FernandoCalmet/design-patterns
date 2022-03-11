[![Github][github-shield]][github-url]
[![Kofi][kofi-shield]][kofi-url]
[![LinkedIn][linkedin-shield]][linkedin-url]
[![Khanakat][khanakat-shield]][khanakat-url]

# Patrones de Diseño de Software con CSharp

## Patrones Creacionales

Imagen | Patrón | Puntuación | Descripción
--- | --- | --- | ---
![img-abstract-factory](../.github/img/abstract-factory-mini.png) | [Abstract Factory](https://github.com/FernandoCalmet/Design-Patterns/wiki/abstract_factory) | ⭐⭐⭐ | Permite producir familias de objetos relacionados sin especificar sus clases concretas.
![img-abstract-factory](../.github/img/builder-mini.png) | [Builder](https://github.com/FernandoCalmet/Design-Patterns/wiki/builder) | ⭐⭐⭐ | Permite construir objetos complejos paso a paso. Este patrón nos permite producir distintos tipos y representaciones de un objeto empleando el mismo código de construcción.
![img-factory-method](../.github/img/factory-method-mini.png) | [Factory Method](https://github.com/FernandoCalmet/Design-Patterns/wiki/factory_method) | ⭐⭐⭐ | Proporciona una interfaz para la creación de objetos en una superclase, mientras permite a las subclases alterar el tipo de objetos que se crearán.
![img-prototype](../.github/img/prototype-mini.png) | [Prototype](https://github.com/FernandoCalmet/Design-Patterns/wiki/prototype) | ⭐⭐ | Permite copiar objetos existentes sin que el código dependa de sus clases.
![img-singleton](../.github/img/singleton-mini.png) | [Singleton](https://github.com/FernandoCalmet/Design-Patterns/wiki/singleton) | ⭐⭐ | Permite asegurarnos de que una clase tenga una única instancia, a la vez que proporciona un punto de acceso global a dicha instancia.

## Patrones Estructurales

Imagen | Patrón | Puntuación | Descripción
--- | --- | --- | ---
![img-adapter](../.github/img/singleton-mini.png) | [Adapter](https://github.com/FernandoCalmet/Design-Patterns/wiki/adapter) | ⭐⭐⭐ | Permite la colaboración entre objetos con interfaces incompatibles.
![img-bridge](../.github/img/bridge-mini.png) | [Bridge](https://github.com/FernandoCalmet/Design-Patterns/wiki/bridge) | ⭐ | Permite dividir una clase grande o un grupo de clases estrechamente relacionadas, en dos jerarquías separadas (abstracción e implementación) que pueden desarrollarse independientemente la una de la otra.
![img-composite](../.github/img/composite-mini.png) | [Composite](https://github.com/FernandoCalmet/Design-Patterns/wiki/composite) | ⭐⭐ | Permite componer objetos en estructuras de árbol y trabajar con esas estructuras como si fueran objetos individuales.
![img-decorator](../.github/img/decorator-mini.png) | [Decorator](https://github.com/FernandoCalmet/Design-Patterns/wiki/decorator) | ⭐⭐ | Permite añadir funcionalidades a objetos colocando estos objetos dentro de objetos encapsuladores especiales que contienen estas funcionalidades.
![img-facade](../.github/img/facade-mini.png) | [Facade](https://github.com/FernandoCalmet/Design-Patterns/wiki/facade) | ⭐⭐ | Proporciona una interfaz simplificada a una biblioteca, un framework o cualquier otro grupo complejo de clases.
![img-flyweight](../.github/img/flyweight-mini.png) | [Flyweight](https://github.com/FernandoCalmet/Design-Patterns/wiki/flyweight) | ⭐ | Permite mantener más objetos dentro de la cantidad disponible de memoria RAM compartiendo las partes comunes del estado entre varios objetos en lugar de mantener toda la información en cada objeto.
![img-proxy](../.github/img/proxy-mini.png) | [Proxy](https://github.com/FernandoCalmet/Design-Patterns/wiki/proxy) | ⭐ | Permite proporcionar un sustituto o marcador de posición para otro objeto. Un proxy controla el acceso al objeto original, permitiéndote hacer algo antes o después de que la solicitud llegue al objeto original.

## Patrones de Comportamiento

Imagen | Patrón | Puntuación | Descripción
--- | --- | --- | ---
![img-chain-of-responsibility](../.github/img/chain-of-responsibility-mini.png) | [Chain of Responsibility](https://github.com/FernandoCalmet/Design-Patterns/wiki/chain_of_responsibility) | ⭐ | Permite pasar solicitudes a lo largo de una cadena de manejadores. Al recibir una solicitud, cada manejador decide si la procesa o si la pasa al siguiente manejador de la cadena.
![img-command](../.github/img/command-mini.png) | [Command](https://github.com/FernandoCalmet/Design-Patterns/wiki/command) | ⭐⭐⭐ | Convierte una solicitud en un objeto independiente que contiene toda la información sobre la solicitud. Esta transformación te permite parametrizar los métodos con diferentes solicitudes, retrasar o poner en cola la ejecución de una solicitud y soportar operaciones que no se pueden realizar.
![img-iterator](../.github/img/iterator-mini.png) | [Iterator](https://github.com/FernandoCalmet/Design-Patterns/wiki/iterator) | ⭐⭐⭐ | Permite recorrer elementos de una colección sin exponer su representación subyacente (lista, pila, árbol, etc.).
![img-mediator](../.github/img/mediator-mini.png) | [Mediator](https://github.com/FernandoCalmet/Design-Patterns/wiki/mediator) | ⭐⭐ | Permite reducir las dependencias caóticas entre objetos. El patrón restringe las comunicaciones directas entre los objetos, forzándolos a colaborar únicamente a través de un objeto mediador
![img-memento](../.github/img/memento-mini.png) | [Memento](https://github.com/FernandoCalmet/Design-Patterns/wiki/memento) | ⭐⭐ | Permite guardar y restaurar el estado previo de un objeto sin revelar los detalles de su implementación.
![img-observer](../.github/img/observer-mini.png) | [Observer](https://github.com/FernandoCalmet/Design-Patterns/wiki/observer) | ⭐⭐⭐ | Permite definir un mecanismo de suscripción para notificar a varios objetos sobre cualquier evento que le suceda al objeto que están observando.
![img-state](../.github/img/state-mini.png) | [State](https://github.com/FernandoCalmet/Design-Patterns/wiki/state) | ⭐⭐⭐ | Permite a un objeto alterar su comportamiento cuando su estado interno cambia. Parece como si el objeto cambiara su clase.
![img-strategy](../.github/img/strategy-mini.png) | [Strategy](https://github.com/FernandoCalmet/Design-Patterns/wiki/strategy) | ⭐⭐⭐ | Permite definir una familia de algoritmos, colocar cada uno de ellos en una clase separada y hacer sus objetos intercambiables.
![img-template-method](../.github/img/template-method-mini.png) | [Template Method](./template_method) | ⭐⭐ | Define el esqueleto de un algoritmo en la superclase pero permite que las subclases sobrescriban pasos del algoritmo sin cambiar su estructura.
![img-visitor](../.github/img/visitor-mini.png) | [Visitor](https://github.com/FernandoCalmet/Design-Patterns/wiki/visitor) | ⭐⭐ | Permite separar algoritmos de los objetos sobre los que operan.

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