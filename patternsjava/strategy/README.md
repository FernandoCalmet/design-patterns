# Strategy Pattern

En el patrón de estrategia, el comportamiento de una clase o su algoritmo se puede cambiar en tiempo de ejecución. Este tipo de patrón de diseño se incluye en el patrón de comportamiento.

En el patrón de estrategia, creamos objetos que representan varias estrategias y un objeto de contexto cuyo comportamiento varía según su objeto de estrategia. El objeto de estrategia cambia el algoritmo de ejecución del objeto de contexto.

## Implementación

Vamos a crear una interfaz de estrategia que defina una acción y clases de estrategia concretas implementando la interfaz de estrategia. El contexto es una clase que usa una estrategia.

StrategyPatternDemo, nuestra clase de demostración, utilizará objetos de contexto y estrategia para demostrar el cambio en el comportamiento del contexto en función de la estrategia que implementa o utiliza.

![UML Diagram](strategy_pattern_uml_diagram.jpg)

## Paso 1

Crea una interfaz.

> Strategy.java

```java
public interface Strategy {
   public int doOperation(int num1, int num2);
}
```

## Paso 2

Crea clases concretas implementando la misma interfaz.

> OperationAdd.java

```java
public class OperationAdd implements Strategy{
   @Override
   public int doOperation(int num1, int num2) {
      return num1 + num2;
   }
}
```

> OperationSubstract.java

```java
public class OperationSubstract implements Strategy{
   @Override
   public int doOperation(int num1, int num2) {
      return num1 - num2;
   }
}
```

> OperationMultiply.java

```java
public class OperationMultiply implements Strategy{
   @Override
   public int doOperation(int num1, int num2) {
      return num1 * num2;
   }
}
```

## Paso 3

Crear clase de contexto.

> Context.java

```java
public class Context {
   private Strategy strategy;

   public Context(Strategy strategy){
      this.strategy = strategy;
   }

   public int executeStrategy(int num1, int num2){
      return strategy.doOperation(num1, num2);
   }
}
```

## Paso 4

Utilice el contexto para ver cambios en el comportamiento cuando cambia su estrategia.

> StrategyPatternDemo.java

```java
public class StrategyPatternDemo {
   public static void main(String[] args) {
      Context context = new Context(new OperationAdd());
      System.out.println("10 + 5 = " + context.executeStrategy(10, 5));

      context = new Context(new OperationSubstract());
      System.out.println("10 - 5 = " + context.executeStrategy(10, 5));

      context = new Context(new OperationMultiply());
      System.out.println("10 * 5 = " + context.executeStrategy(10, 5));
   }
}
```

## Paso 5

Verifique la salida.

```note
10 + 5 = 15
10 - 5 = 5
10 * 5 = 50
```

---
:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
