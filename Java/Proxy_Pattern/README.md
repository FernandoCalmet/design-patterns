# Proxy Pattern

In proxy pattern, a class represents functionality of another class. This type of design pattern comes under structural pattern.

In proxy pattern, we create object having original object to interface its functionality to outer world.

## Implementation

We are going to create an Image interface and concrete classes implementing the Image interface. ProxyImage is a a proxy class to reduce memory footprint of RealImage object loading.

ProxyPatternDemo, our demo class, will use ProxyImage to get an Image object to load and display as it needs.

![UML Diagram](proxy_pattern_uml_diagram.jpg)

## Step 1

Create an interface.

_Image.java_

```java
public interface Image {
   void display();
}
```

## Step 2

Create concrete classes implementing the same interface.

_RealImage.java_

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

_ProxyImage.java_

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

## Step 3

Use the ProxyImage to get object of RealImage class when required.

_ProxyPatternDemo.java_

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

## Step 4

Verify the output.

```
Loading test_10mb.jpg
Displaying test_10mb.jpg

Displaying test_10mb.jpg
```

:octocat: [Check more about Design Patterns in my repository.](https://github.com/FernandoCalmet/Design-Patterns)

## Support me ☕💖

<a href='https://ko-fi.com/fernandocalmet' target='_blank'>
  <img height='36' style='border:0px;height:36px;' src='https://az743702.vo.msecnd.net/cdn/kofi3.png?v=2' border='0' alt='Buy Me a Coffee at ko-fi.com' />
</a>
