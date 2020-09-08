# Flyweight Pattern

El patrón Flyweight se utiliza principalmente para reducir la cantidad de objetos creados y para disminuir la huella de memoria y aumentar el rendimiento. Este tipo de patrón de diseño se incluye en el patrón estructural, ya que este patrón proporciona formas de disminuir el número de objetos, mejorando así la estructura del objeto de aplicación.

El patrón Flyweight intenta reutilizar objetos de tipo similar ya existentes almacenándolos y crea un objeto nuevo cuando no se encuentra ningún objeto coincidente. Demostraremos este patrón dibujando 20 círculos de diferentes ubicaciones, pero crearemos solo 5 objetos. Solo hay 5 colores disponibles, por lo que la propiedad de color se usa para verificar los objetos Circle ya existentes.

## Implementación

Vamos a crear una interfaz Shape y una clase concreta Circle implementando la interfaz Shape. Una clase de fábrica ShapeFactory se define como el siguiente paso.

ShapeFactory tiene un HashMap of Circle con clave como color del objeto Circle. Siempre que llega una solicitud para crear un círculo de un color particular en ShapeFactory, verifica el objeto del círculo en su HashMap, si se encuentra el objeto del Círculo, ese objeto se devuelve; de lo contrario, se crea un nuevo objeto, se almacena en hashmap para uso futuro y se devuelve a cliente.

FlyWeightPatternDemo, nuestra clase de demostración, usará ShapeFactory para obtener un objeto Shape. Pasará información (rojo / verde / azul / negro / blanco) a ShapeFactory para obtener el círculo del color deseado que necesita.

![UML Diagram](flyweight_pattern_uml_diagram.jpg)

## Paso 1

Crea una interfaz.

> Shape.java

```java
public interface Shape {
   void draw();
}
```

## Paso 2

Cree una clase concreta implementando la misma interfaz.

> Circle.java

```java
public class Circle implements Shape {
   private String color;
   private int x;
   private int y;
   private int radius;

   public Circle(String color){
      this.color = color;
   }

   public void setX(int x) {
      this.x = x;
   }

   public void setY(int y) {
      this.y = y;
   }

   public void setRadius(int radius) {
      this.radius = radius;
   }

   @Override
   public void draw() {
      System.out.println("Circle: Draw() [Color : " + color + ", x : " + x + ", y :" + y + ", radius :" + radius);
   }
}
```

## Paso 3

Cree una fábrica para generar objetos de clase concreta en función de la información dada.

> ShapeFactory.java

```java
import java.util.HashMap;

public class ShapeFactory {

   // Uncomment the compiler directive line and
   // javac *.java will compile properly.
   // @SuppressWarnings("unchecked")
   private static final HashMap circleMap = new HashMap();

   public static Shape getCircle(String color) {
      Circle circle = (Circle)circleMap.get(color);

      if(circle == null) {
         circle = new Circle(color);
         circleMap.put(color, circle);
         System.out.println("Creating circle of color : " + color);
      }
      return circle;
   }
}
```

## Paso 4

Utilice la fábrica para obtener un objeto de clase concreta pasando una información como el color.

> FlyweightPatternDemo.java

```java
public class FlyweightPatternDemo {
   private static final String colors[] = { "Red", "Green", "Blue", "White", "Black" };
   public static void main(String[] args) {

      for(int i=0; i < 20; ++i) {
         Circle circle = (Circle)ShapeFactory.getCircle(getRandomColor());
         circle.setX(getRandomX());
         circle.setY(getRandomY());
         circle.setRadius(100);
         circle.draw();
      }
   }
   private static String getRandomColor() {
      return colors[(int)(Math.random()*colors.length)];
   }
   private static int getRandomX() {
      return (int)(Math.random()*100 );
   }
   private static int getRandomY() {
      return (int)(Math.random()*100);
   }
}
```

## Paso 5

Verifique la salida.

```note
Creating circle of color : Black
Circle: Draw() [Color : Black, x : 36, y :71, radius :100
Creating circle of color : Green
Circle: Draw() [Color : Green, x : 27, y :27, radius :100
Creating circle of color : White
Circle: Draw() [Color : White, x : 64, y :10, radius :100
Creating circle of color : Red
Circle: Draw() [Color : Red, x : 15, y :44, radius :100
Circle: Draw() [Color : Green, x : 19, y :10, radius :100
Circle: Draw() [Color : Green, x : 94, y :32, radius :100
Circle: Draw() [Color : White, x : 69, y :98, radius :100
Creating circle of color : Blue
Circle: Draw() [Color : Blue, x : 13, y :4, radius :100
Circle: Draw() [Color : Green, x : 21, y :21, radius :100
Circle: Draw() [Color : Blue, x : 55, y :86, radius :100
Circle: Draw() [Color : White, x : 90, y :70, radius :100
Circle: Draw() [Color : Green, x : 78, y :3, radius :100
Circle: Draw() [Color : Green, x : 64, y :89, radius :100
Circle: Draw() [Color : Blue, x : 3, y :91, radius :100
Circle: Draw() [Color : Blue, x : 62, y :82, radius :100
Circle: Draw() [Color : Green, x : 97, y :61, radius :100
Circle: Draw() [Color : Green, x : 86, y :12, radius :100
Circle: Draw() [Color : Green, x : 38, y :93, radius :100
Circle: Draw() [Color : Red, x : 76, y :82, radius :100
Circle: Draw() [Color : Blue, x : 95, y :82, radius :100
```

---
:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
