# State Pattern

En el patrón de estado, el comportamiento de una clase cambia según su estado. Este tipo de patrón de diseño se incluye en el patrón de comportamiento.

En el patrón de estado, creamos objetos que representan varios estados y un objeto de contexto cuyo comportamiento varía a medida que cambia su objeto de estado.

## Implementación

Vamos a crear una interfaz de estado que defina una acción y clases de estado concretas que implementen la interfaz de estado. El contexto es una clase que conlleva un Estado.

StatePatternDemo, nuestra clase de demostración, utilizará objetos de contexto y estado para demostrar cambios en el comportamiento de contexto según el tipo de estado en el que se encuentra.

![UML Diagram](state_pattern_uml_diagram.jpg)

## Paso 1

Crea una interfaz.

> State.java

```java
public interface State {
   public void doAction(Context context);
}
```

## Paso 2

Crea clases concretas implementando la misma interfaz.

> StartState.java

```java
public class StartState implements State {

   public void doAction(Context context) {
      System.out.println("Player is in start state");
      context.setState(this);
   }

   public String toString(){
      return "Start State";
   }
}
```

> StopState.java

```java
public class StopState implements State {

   public void doAction(Context context) {
      System.out.println("Player is in stop state");
      context.setState(this);
   }

   public String toString(){
      return "Stop State";
   }
}
```

## Paso 3

Crear clase de contexto.

> Context.java

```java
public class Context {
   private State state;

   public Context(){
      state = null;
   }

   public void setState(State state){
      this.state = state;
   }

   public State getState(){
      return state;
   }
}
```

## Paso 4

Utilice el contexto para ver cambios en el comportamiento cuando cambia el estado.

> StatePatternDemo.java

```java
public class StatePatternDemo {
   public static void main(String[] args) {
      Context context = new Context();

      StartState startState = new StartState();
      startState.doAction(context);

      System.out.println(context.getState().toString());

      StopState stopState = new StopState();
      stopState.doAction(context);

      System.out.println(context.getState().toString());
   }
}
```

## Paso 5

Verifique la salida.

```note
Player is in start state
Start State
Player is in stop state
Stop State
```

---
:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
