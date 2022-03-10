# Proxy Pattern

En el patrón de proxy, una clase representa la funcionalidad de otra clase. Este tipo de patrón de diseño viene bajo patrón estructural.

En el patrón de proxy, creamos un objeto que tiene un objeto original para interconectar su funcionalidad con el mundo exterior.

## Implementación

Vamos a crear una interfaz de imagen y clases concretas implementando la interfaz de imagen. ProxyImage es una clase de proxy para reducir la huella de memoria de la carga de objetos RealImage.

ProxyPatternDemo, nuestra clase de demostración, utilizará ProxyImage para que un objeto Image se cargue y muestre según sea necesario.

![UML Diagram](proxy_pattern_uml_diagram.jpg)

## Paso 1

Crea una interfaz.

> Image.java

```java
public interface Image {
   void display();
}
```

## Paso 2

Crea clases concretas implementando la misma interfaz.

> RealImage.java

```java
public class RealImage implements Image {

   private String fileName;

   public RealImage(String fileName){
      this.fileName = fileName;
      loadFromDisk(fileName);
   }

   @Override
   public void display() {
      System.out.println("Displaying " + fileName);
   }

   private void loadFromDisk(String fileName){
      System.out.println("Loading " + fileName);
   }
}
```

> ProxyImage.java

```java
public class ProxyImage implements Image{

   private RealImage realImage;
   private String fileName;

   public ProxyImage(String fileName){
      this.fileName = fileName;
   }

   @Override
   public void display() {
      if(realImage == null){
         realImage = new RealImage(fileName);
      }
      realImage.display();
   }
}
```

## Paso 3

Utilice ProxyImage para obtener el objeto de la clase RealImage cuando sea necesario.

> ProxyPatternDemo.java

```java
public class ProxyPatternDemo {

   public static void main(String[] args) {
      Image image = new ProxyImage("test_10mb.jpg");

      //image will be loaded from disk
      image.display();
      System.out.println("");

      //image will not be loaded from disk
      image.display();
   }
}
```

## Paso 4

Verifique la salida.

```note
Loading test_10mb.jpg
Displaying test_10mb.jpg

Displaying test_10mb.jpg
```

---
:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
