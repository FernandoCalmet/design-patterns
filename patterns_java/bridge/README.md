# Bridge Pattern

Bridge se utiliza cuando necesitamos desacoplar una abstracción de su Implementación para que las dos puedan variar de forma independiente. Este tipo de patrón de diseño viene bajo patrón estructural ya que este patrón desacopla la clase Implementación y la clase abstracta al proporcionar una estructura de puente entre ellas.

Este patrón involucra una interfaz que actúa como un puente que hace que la funcionalidad de clases concretas sea independiente de las clases implementadoras de interfaz. Ambos tipos de clases pueden modificarse estructuralmente sin que se afecten entre sí.

Estamos demostrando el uso del patrón Bridge a través del siguiente ejemplo en el que se puede dibujar un círculo en diferentes colores usando el mismo método de clase abstracta pero diferentes clases de implementación de puentes.

## Implementación

Tenemos una interfaz DrawAPI que actúa como un implementador de puentes y clases concretas RedCircle, GreenCircle implementando la interfaz DrawAPI. Shape es una clase abstracta y utilizará el objeto de DrawAPI. BridgePatternDemo, nuestra clase de demostración usará la clase Shape para dibujar círculos de diferentes colores.

![UML Diagram](bridge_pattern_uml_diagram.jpg)

## Paso 1

Cree la interfaz del implementador del puente.

> DrawAPI.java

```java
public interface DrawAPI {
   public void drawCircle(int radius, int x, int y);
}
```

## Paso 2

Cree clases de implementador de puentes concretos que implementen la interfaz DrawAPI.

> RedCircle.java

```java
public class RedCircle implements DrawAPI {
   @Override
   public void drawCircle(int radius, int x, int y) {
      System.out.println("Drawing Circle[ color: red, radius: " + radius + ", x: " + x + ", " + y + "]");
   }
}
```

> GreenCircle.java

```java
public class GreenCircle implements DrawAPI {
   @Override
   public void drawCircle(int radius, int x, int y) {
      System.out.println("Drawing Circle[ color: green, radius: " + radius + ", x: " + x + ", " + y + "]");
   }
}
```

## Paso 3

Cree una forma de clase abstracta utilizando la interfaz DrawAPI.

> Shape.java

```java
public abstract class Shape {
   protected DrawAPI drawAPI;

   protected Shape(DrawAPI drawAPI){
      this.drawAPI = drawAPI;
   }
   public abstract void draw();
}
```

## Paso 4

Cree una clase concreta implementando la interfaz Shape.

> Circle.java

```java
public class Circle extends Shape {
   private int x, y, radius;

   public Circle(int x, int y, int radius, DrawAPI drawAPI) {
      super(drawAPI);
      this.x = x;  
      this.y = y;  
      this.radius = radius;
   }

   public void draw() {
      drawAPI.drawCircle(radius,x,y);
   }
}
```

## Paso 5

Utilice las clases Shape y DrawAPI para dibujar círculos de diferentes colores.

> BridgePatternDemo.java

```java
public class BridgePatternDemo {
   public static void main(String[] args) {
      Shape redCircle = new Circle(100,100, 10, new RedCircle());
      Shape greenCircle = new Circle(100,100, 10, new GreenCircle());

      redCircle.draw();
      greenCircle.draw();
   }
}
```

## Paso 6

Verifique la salida.

```note
Drawing Circle[ color: red, radius: 10, x: 100, 100]
Drawing Circle[  color: green, radius: 10, x: 100, 100]
```

---
:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
