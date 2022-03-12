# Prototype Pattern

El patrón de prototipo se refiere a la creación de un objeto duplicado teniendo en cuenta el rendimiento. Este tipo de patrón de diseño se incluye en el patrón de creación, ya que este patrón proporciona una de las mejores formas de crear un objeto.

Este patrón implica la implementación de una interfaz de prototipo que le dice que cree un clon del objeto actual. Este patrón se utiliza cuando la creación de un objeto directamente es costosa. Por ejemplo, un objeto debe crearse después de una costosa operación de base de datos. Podemos almacenar en caché el objeto, devolver su clon en la próxima solicitud y actualizar la base de datos cuando sea necesario, reduciendo así las llamadas a la base de datos.

## Implementación

Vamos a crear una clase abstracta Shape y clases concretas ampliando la clase Shape. Una clase ShapeCache se define como el siguiente paso que almacena objetos de forma en una tabla hash y devuelve su clon cuando se solicita.

PrototypPatternDemo, nuestra clase de demostración usará la clase ShapeCache para obtener un objeto Shape.

![UML Diagram](prototype_pattern_uml_diagram.jpg)

## Paso 1

Cree una clase abstracta que implemente la interfaz Cloneable.

> Shape.java

```java
public abstract class Shape implements Cloneable {

   private String id;
   protected String type;

   abstract void draw();

   public String getType(){
      return type;
   }

   public String getId() {
      return id;
   }

   public void setId(String id) {
      this.id = id;
   }

   public Object clone() {
      Object clone = null;

      try {
         clone = super.clone();

      } catch (CloneNotSupportedException e) {
         e.printStackTrace();
      }

      return clone;
   }
}
```

## Paso 2

Cree clases concretas ampliando la clase anterior.

> Rectangle.java

```java
public class Rectangle extends Shape {

   public Rectangle(){
     type = "Rectangle";
   }

   @Override
   public void draw() {
      System.out.println("Inside Rectangle::draw() method.");
   }
}
```

> Square.java

```java
public class Square extends Shape {

   public Square(){
     type = "Square";
   }

   @Override
   public void draw() {
      System.out.println("Inside Square::draw() method.");
   }
}
```

> Circle.java

```java
public class Circle extends Shape {

   public Circle(){
     type = "Circle";
   }

   @Override
   public void draw() {
      System.out.println("Inside Circle::draw() method.");
   }
}
```

## Paso 3

Cree una clase para obtener clases concretas de la base de datos y almacenarlas en una Hashtable.

> ShapeCache.java

```java
import java.util.Hashtable;

public class ShapeCache {

   private static Hashtable<String, Shape> shapeMap  = new Hashtable<String, Shape>();

   public static Shape getShape(String shapeId) {
      Shape cachedShape = shapeMap.get(shapeId);
      return (Shape) cachedShape.clone();
   }

   // for each shape run database query and create shape
   // shapeMap.put(shapeKey, shape);
   // for example, we are adding three shapes

   public static void loadCache() {
      Circle circle = new Circle();
      circle.setId("1");
      shapeMap.put(circle.getId(),circle);

      Square square = new Square();
      square.setId("2");
      shapeMap.put(square.getId(),square);

      Rectangle rectangle = new Rectangle();
      rectangle.setId("3");
      shapeMap.put(rectangle.getId(), rectangle);
   }
}
```

## Paso 4

PrototypePatternDemo usa la clase ShapeCache para obtener clones de formas almacenadas en una Hashtable.

> PrototypePatternDemo.java

```java
public class PrototypePatternDemo {
   public static void main(String[] args) {
      ShapeCache.loadCache();

      Shape clonedShape = (Shape) ShapeCache.getShape("1");
      System.out.println("Shape : " + clonedShape.getType());

      Shape clonedShape2 = (Shape) ShapeCache.getShape("2");
      System.out.println("Shape : " + clonedShape2.getType());

      Shape clonedShape3 = (Shape) ShapeCache.getShape("3");
      System.out.println("Shape : " + clonedShape3.getType());
   }
}
```

## Paso 5

Verifique la salida.

```note
Shape : Circle
Shape : Square
Shape : Rectangle
```

---
:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
