# Facade Pattern

El patrón de fachada oculta las complejidades del sistema y proporciona una interfaz al cliente mediante la cual el cliente puede acceder al sistema. Este tipo de patrón de diseño viene bajo patrón estructural ya que este patrón agrega una interfaz al sistema existente para ocultar sus complejidades.

Este patrón involucra una sola clase que proporciona métodos simplificados requeridos por el cliente y delega llamadas a métodos de clases de sistema existentes.

## Implementación

Vamos a crear una interfaz Shape y clases concretas implementando la interfaz Shape. Una clase de fachada ShapeMaker se define como el siguiente paso.

La clase ShapeMaker usa las clases concretas para delegar las llamadas de los usuarios a estas clases. FacadePatternDemo, nuestra clase de demostración, utilizará la clase ShapeMaker para mostrar los resultados.

![UML Diagram](facade_pattern_uml_diagram.jpg)

## Paso 1

Crea una interfaz.

> Shape.java

```java
public interface Shape {
   void draw();
}
```

## Paso 2

Crea clases concretas implementando la misma interfaz.

> Rectangle.java

```java
public class Rectangle implements Shape {

   @Override
   public void draw() {
      System.out.println("Rectangle::draw()");
   }
}
```

> Square.java

```java
public class Square implements Shape {

   @Override
   public void draw() {
      System.out.println("Square::draw()");
   }
}
```

> Circle.java

```java
public class Circle implements Shape {

   @Override
   public void draw() {
      System.out.println("Circle::draw()");
   }
}
```

## Paso 3

Crea una clase de fachada.

> ShapeMaker.java

```java
public class ShapeMaker {
   private Shape circle;
   private Shape rectangle;
   private Shape square;

   public ShapeMaker() {
      circle = new Circle();
      rectangle = new Rectangle();
      square = new Square();
   }

   public void drawCircle(){
      circle.draw();
   }
   public void drawRectangle(){
      rectangle.draw();
   }
   public void drawSquare(){
      square.draw();
   }
}
```

## Paso 4

Usa la fachada para dibujar varios tipos de formas.

> FacadePatternDemo.java

```java
public class FacadePatternDemo {
   public static void main(String[] args) {
      ShapeMaker shapeMaker = new ShapeMaker();

      shapeMaker.drawCircle();
      shapeMaker.drawRectangle();
      shapeMaker.drawSquare();
   }
}
```

## Paso 5

Verifique la salida.

```note
Circle::draw()
Rectangle::draw()
Square::draw()
```

---
:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
