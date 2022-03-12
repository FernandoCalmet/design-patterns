# Decorator Pattern

El patrón de decorador permite al usuario agregar una nueva funcionalidad a un objeto existente sin alterar su estructura. Este tipo de patrón de diseño se incluye en el patrón estructural, ya que este patrón actúa como un envoltorio para la clase existente.

Este patrón crea una clase decoradora que envuelve la clase original y proporciona funcionalidad adicional manteniendo intacta la firma de los métodos de clase.

Estamos demostrando el uso del patrón decorador a través del siguiente ejemplo en el que decoraremos una forma con algún color sin alterar la clase de forma.

## Implementación

Vamos a crear una interfaz Shape y clases concretas implementando la interfaz Shape. Luego crearemos una clase decoradora abstracta ShapeDecorator implementando la interfaz Shape y teniendo el objeto Shape como su variable de instancia.

RedShapeDecorator es una clase concreta que implementa ShapeDecorator.

DecoratorPatternDemo, nuestra clase de demostración utilizará RedShapeDecorator para decorar objetos Shape.

![UML Diagram](decorator_pattern_uml_diagram.jpg)

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
      System.out.println("Shape: Rectangle");
   }
}
```

> Circle.java

```java
public class Circle implements Shape {

   @Override
   public void draw() {
      System.out.println("Shape: Circle");
   }
}
```

## Paso 3

Cree una clase decoradora abstracta implementando la interfaz Shape.

> ShapeDecorator.java

```java
public abstract class ShapeDecorator implements Shape {
   protected Shape decoratedShape;

   public ShapeDecorator(Shape decoratedShape){
      this.decoratedShape = decoratedShape;
   }

   public void draw(){
      decoratedShape.draw();
   }
}
```

## Paso 4

Cree una clase de decorador concreta ampliando la clase ShapeDecorator.

> RedShapeDecorator.java

```java
public class RedShapeDecorator extends ShapeDecorator {

   public RedShapeDecorator(Shape decoratedShape) {
      super(decoratedShape);
   }

   @Override
   public void draw() {
      decoratedShape.draw();
      setRedBorder(decoratedShape);
   }

   private void setRedBorder(Shape decoratedShape){
      System.out.println("Border Color: Red");
   }
}
```

## Paso 5

Utilice RedShapeDecorator para decorar objetos Shape.

> DecoratorPatternDemo.java

```java
public class DecoratorPatternDemo {
   public static void main(String[] args) {

      Shape circle = new Circle();

      Shape redCircle = new RedShapeDecorator(new Circle());

      Shape redRectangle = new RedShapeDecorator(new Rectangle());
      System.out.println("Circle with normal border");
      circle.draw();

      System.out.println("\nCircle of red border");
      redCircle.draw();

      System.out.println("\nRectangle of red border");
      redRectangle.draw();
   }
}
```

## Paso 6

Verifique la salida.

```note
Circle with normal border
Shape: Circle

Circle of red border
Shape: Circle
Border Color: Red

Rectangle of red border
Shape: Rectangle
Border Color: Red
```

---
:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
