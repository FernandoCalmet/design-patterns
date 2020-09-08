# Abstract Factory Pattern

Los patrones de Abstract Factory funcionan alrededor de una superfábrica que crea otras fábricas. Esta fábrica también se denomina fábrica de fábricas. Este tipo de patrón de diseño se incluye en el patrón de creación, ya que este patrón proporciona una de las mejores formas de crear un objeto.

En el patrón Abstract Factory, una interfaz es responsable de crear una fábrica de objetos relacionados sin especificar explícitamente sus clases. Cada fábrica generada puede dar los objetos según el patrón de fábrica.

## Implementación

Vamos a crear una interfaz Shape y una clase concreta implementándola. Creamos una clase de fábrica abstracta AbstractFactory como siguiente paso. Se define la clase de fábrica ShapeFactory, que amplía AbstractFactory. Se crea una clase FactoryProducer de creador / generador de fábrica.

AbstractFactoryPatternDemo, nuestra clase de demostración usa FactoryProducer para obtener un objeto AbstractFactory. Pasará información (CIRCLE / RECTANGLE / SQUARE para Shape) a AbstractFactory para obtener el tipo de objeto que necesita.

![UML Diagram](abstractfactory_pattern_uml_diagram.jpg)

## Paso 1

Crea una interfaz para Shapes.

> Shape.java

```java
public interface Shape {
   void draw();
}
```

## Paso 2

Crea clases concretas implementando la misma interfaz.

> RoundedRectangle.java

```java
public class RoundedRectangle implements Shape {
   @Override
   public void draw() {
      System.out.println("Inside RoundedRectangle::draw() method.");
   }
}
```

> RoundedSquare.java

```java
public class RoundedSquare implements Shape {
   @Override
   public void draw() {
      System.out.println("Inside RoundedSquare::draw() method.");
   }
}
```

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

## Paso 3

Cree una clase abstracta para obtener fábricas de objetos de forma normal y redondeada.

> AbstractFactory.java

```java
public abstract class AbstractFactory {
   abstract Shape getShape(String shapeType) ;
}
```

## Paso 4

Cree clases de Factory ampliando AbstractFactory para generar objetos de clase concreta basados en información dada.

> ShapeFactory.java

```java
public class ShapeFactory extends AbstractFactory {
   @Override
   public Shape getShape(String shapeType){
      if(shapeType.equalsIgnoreCase("RECTANGLE")){
         return new Rectangle();
      }else if(shapeType.equalsIgnoreCase("SQUARE")){
         return new Square();
      }
      return null;
   }
}
```

> RoundedShapeFactory.java

```java
public class RoundedShapeFactory extends AbstractFactory {
   @Override
   public Shape getShape(String shapeType){
      if(shapeType.equalsIgnoreCase("RECTANGLE")){
         return new RoundedRectangle();
      }else if(shapeType.equalsIgnoreCase("SQUARE")){
         return new RoundedSquare();
      }
      return null;
   }
}
```

## Paso 5

Cree una clase de generador / productor de fábrica para obtener fábricas pasando una información como Shape

> FactoryProducer.java

```java
public class FactoryProducer {
   public static AbstractFactory getFactory(boolean rounded){
      if(rounded){
         return new RoundedShapeFactory();
      }else{
         return new ShapeFactory();
      }
   }
}
```

## Paso 6

Utilice FactoryProducer para obtener AbstractFactory con el fin de obtener fábricas de clases concretas pasando una información como el tipo.

> AbstractFactoryPatternDemo.java

```java
public class AbstractFactoryPatternDemo {
   public static void main(String[] args) {
      //get shape factory
      AbstractFactory shapeFactory = FactoryProducer.getFactory(false);
      //get an object of Shape Rectangle
      Shape shape1 = shapeFactory.getShape("RECTANGLE");
      //call draw method of Shape Rectangle
      shape1.draw();
      //get an object of Shape Square
      Shape shape2 = shapeFactory.getShape("SQUARE");
      //call draw method of Shape Square
      shape2.draw();
      //get shape factory
      AbstractFactory shapeFactory1 = FactoryProducer.getFactory(true);
      //get an object of Shape Rectangle
      Shape shape3 = shapeFactory1.getShape("RECTANGLE");
      //call draw method of Shape Rectangle
      shape3.draw();
      //get an object of Shape Square
      Shape shape4 = shapeFactory1.getShape("SQUARE");
      //call draw method of Shape Square
      shape4.draw();

   }
}
```

## Paso 7

Verifique la salida.

```note
Inside Rectangle::draw() method.
Inside Square::draw() method.
Inside RoundedRectangle::draw() method.
Inside RoundedSquare::draw() method.
```

---
:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
