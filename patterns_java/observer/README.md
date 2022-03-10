# Observer Pattern

El patrón de observador se usa cuando existe una relación de uno a muchos entre objetos, por ejemplo, si un objeto se modifica, sus objetos dependientes deben notificarse automáticamente. El patrón de observador se incluye en la categoría de patrón de comportamiento.

## Implementación

El patrón de observador utiliza tres clases de actores. Sujeto, observador y cliente. El sujeto es un objeto que tiene métodos para adjuntar y separar observadores de un objeto cliente. Hemos creado una clase abstracta Observador y una clase concreta Sujeto que está ampliando la clase Observador.

![UML Diagram](observer_pattern_uml_diagram.jpg)

## Paso 1

Crear clase de Subject.

> Subject.java

```java
import java.util.ArrayList;
import java.util.List;

public class Subject {

   private List<Observer> observers = new ArrayList<Observer>();
   private int state;

   public int getState() {
      return state;
   }

   public void setState(int state) {
      this.state = state;
      notifyAllObservers();
   }

   public void attach(Observer observer){
      observers.add(observer);
   }

   public void notifyAllObservers(){
      for (Observer observer : observers) {
         observer.update();
      }
   }
}
```

## Paso 2

Crear clase de observador.

> Observer.java

```java
public abstract class Observer {
   protected Subject subject;
   public abstract void update();
}
```

## Paso 3

Crea clases de observadores concretas

> BinaryObserver.java

```java
public class BinaryObserver extends Observer{

   public BinaryObserver(Subject subject){
      this.subject = subject;
      this.subject.attach(this);
   }

   @Override
   public void update() {
      System.out.println( "Binary String: " + Integer.toBinaryString( subject.getState() ) );
   }
}
```

> OctalObserver.java

```java
public class OctalObserver extends Observer{

   public OctalObserver(Subject subject){
      this.subject = subject;
      this.subject.attach(this);
   }

   @Override
   public void update() {
     System.out.println( "Octal String: " + Integer.toOctalString( subject.getState() ) );
   }
}
```

> HexaObserver.java

```java
public class HexaObserver extends Observer{

   public HexaObserver(Subject subject){
      this.subject = subject;
      this.subject.attach(this);
   }

   @Override
   public void update() {
      System.out.println( "Hex String: " + Integer.toHexString( subject.getState() ).toUpperCase() );
   }
}
```

## Paso 4

Utilice Sujeto y objetos observadores concretos.

> ObserverPatternDemo.java

```java
public class ObserverPatternDemo {
   public static void main(String[] args) {
      Subject subject = new Subject();

      new HexaObserver(subject);
      new OctalObserver(subject);
      new BinaryObserver(subject);

      System.out.println("First state change: 15");
      subject.setState(15);
      System.out.println("Second state change: 10");
      subject.setState(10);
   }
}
```

## Paso 5

Verifique la salida.

```note
First state change: 15
Hex String: F
Octal String: 17
Binary String: 1111
Second state change: 10
Hex String: A
Octal String: 12
Binary String: 1010
```

---
:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
