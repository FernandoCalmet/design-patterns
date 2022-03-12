# Factory Pattern

El patrón de fábrica es uno de los patrones de diseño más utilizados en Java. Este tipo de patrón de diseño se incluye en el patrón de creación, ya que este patrón proporciona una de las mejores formas de crear un objeto.

En el patrón de fábrica, creamos un objeto sin exponer la lógica de creación al cliente y nos referimos al objeto recién creado usando una interfaz común.

## Implementación

Vamos a crear una interfaz Shape y clases concretas implementando la interfaz Shape. Una clase de fábrica ShapeFactory se define como el siguiente paso.

FactoryPatternDemo, nuestra clase de demostración utilizará ShapeFactory para obtener un objeto Shape. Pasará información (CÍRCULO / RECTÁNGULO / CUADRADO) a ShapeFactory para obtener el tipo de objeto que necesita.

![UML Diagram](factory_pattern_uml_diagram.jpg)

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
      System.out.println("Inside Rectangle::draw() method.");
   }
}
```

> Square.java

```java
public class Square implements Shape {

   @Override
   public void draw() {
      System.out.println("Inside Square::draw() method.");
   }
}
```

> Circle.java

```java
public class Circle implements Shape {

   @Override
   public void draw() {
      System.out.println("Inside Circle::draw() method.");
   }
}
```

## Paso 3

Cree una fábrica para generar un objeto de clase concreta basado en información dada.

> ShapeFactory.java

```java
public class ShapeFactory {

   //use getShape method to get object of type shape
   public Shape getShape(String shapeType){
      if(shapeType == null){
         return null;
      }
      if(shapeType.equalsIgnoreCase("CIRCLE")){
         return new Circle();

      } else if(shapeType.equalsIgnoreCase("RECTANGLE")){
         return new Rectangle();

      } else if(shapeType.equalsIgnoreCase("SQUARE")){
         return new Square();
      }

      return null;
   }
}
```

## Paso 4

Utilice Factory para obtener un objeto de una clase concreta pasando una información como el tipo.

> FactoryPatternDemo.java

```java
public class FactoryPatternDemo {

   public static void main(String[] args) {
      ShapeFactory shapeFactory = new ShapeFactory();

      //get an object of Circle and call its draw method.
      Shape shape1 = shapeFactory.getShape("CIRCLE");

      //call draw method of Circle
      shape1.draw();

      //get an object of Rectangle and call its draw method.
      Shape shape2 = shapeFactory.getShape("RECTANGLE");

      //call draw method of Rectangle
      shape2.draw();

      //get an object of Square and call its draw method.
      Shape shape3 = shapeFactory.getShape("SQUARE");

      //call draw method of square
      shape3.draw();
   }
}
```

## Paso 5

Verifique la salida.

```note
Inside Circle::draw() method.
Inside Rectangle::draw() method.
Inside Square::draw() method.
```

---
:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
