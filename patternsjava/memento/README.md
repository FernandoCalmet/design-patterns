# Mediator Pattern

El patrón de recuerdo se utiliza para restaurar el estado de un objeto a un estado anterior. El patrón de recuerdo se incluye en la categoría de patrón de comportamiento.

## Implementación

El patrón Memento utiliza tres clases de actores. Memento contiene el estado de un objeto que se va a restaurar. El originador crea y almacena estados en los objetos Memento y el objeto Caretaker es responsable de restaurar el estado del objeto desde Memento. Hemos creado las clases Memento, Originator y CareTaker.

MementoPatternDemo, nuestra clase de demostración, utilizará los objetos CareTaker y Originator para mostrar la restauración de los estados de los objetos.

![UML Diagram](memento_pattern_uml_diagram.jpg)

## Paso 1

Crea una clase Memento.

> Memento.java

```java
public class Memento {
   private String state;

   public Memento(String state){
      this.state = state;
   }

   public String getState(){
      return state;
   }
}
```

## Paso 2

Crear clase Originador

> Originator.java

```java
public class Originator {
   private String state;

   public void setState(String state){
      this.state = state;
   }

   public String getState(){
      return state;
   }

   public Memento saveStateToMemento(){
      return new Memento(state);
   }

   public void getStateFromMemento(Memento memento){
      state = memento.getState();
   }
}
```

## Paso 3

Crear clase CareTaker

> CareTaker.java

```java
import java.util.ArrayList;
import java.util.List;

public class CareTaker {
   private List<Memento> mementoList = new ArrayList<Memento>();

   public void add(Memento state){
      mementoList.add(state);
   }

   public Memento get(int index){
      return mementoList.get(index);
   }
}
```

## Paso 4

Utilice los objetos CareTaker y Originator.

> MementoPatternDemo.java

```java
public class MementoPatternDemo {
   public static void main(String[] args) {

      Originator originator = new Originator();
      CareTaker careTaker = new CareTaker();

      originator.setState("State #1");
      originator.setState("State #2");
      careTaker.add(originator.saveStateToMemento());

      originator.setState("State #3");
      careTaker.add(originator.saveStateToMemento());

      originator.setState("State #4");
      System.out.println("Current State: " + originator.getState());

      originator.getStateFromMemento(careTaker.get(0));
      System.out.println("First saved State: " + originator.getState());
      originator.getStateFromMemento(careTaker.get(1));
      System.out.println("Second saved State: " + originator.getState());
   }
}
```

## Paso 5

Verifique la salida.

```note
Current State: State #4
First saved State: State #2
Second saved State: State #3
```

---
:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
