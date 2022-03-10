# Mediator Pattern

El patrón de mediador se utiliza para reducir la complejidad de la comunicación entre múltiples objetos o clases. Este patrón proporciona una clase mediadora que normalmente maneja todas las comunicaciones entre diferentes clases y admite un fácil mantenimiento del código mediante un acoplamiento flexible. El patrón de mediador se incluye en la categoría de patrón de comportamiento.

## Implementación

Estamos demostrando un patrón de mediador con el ejemplo de una sala de chat donde varios usuarios pueden enviar mensajes a la sala de chat y es responsabilidad de la sala de chat mostrar los mensajes a todos los usuarios. Hemos creado dos clases ChatRoom y User. Los objetos de usuario utilizarán el método ChatRoom para compartir sus mensajes.

MediatorPatternDemo, nuestra clase de demostración, utilizará objetos de usuario para mostrar la comunicación entre ellos.

![UML Diagram](mediator_pattern_uml_diagram.jpg)

## Paso 1

Crea una clase de mediador.

> ChatRoom.java

```java
import java.util.Date;

public class ChatRoom {
   public static void showMessage(User user, String message){
      System.out.println(new Date().toString() + " [" + user.getName() + "] : " + message);
   }
}
```

## Paso 2

Crear clase de usuario

> User.java

```java
public class User {
   private String name;

   public String getName() {
      return name;
   }

   public void setName(String name) {
      this.name = name;
   }

   public User(String name){
      this.name  = name;
   }

   public void sendMessage(String message){
      ChatRoom.showMessage(this,message);
   }
}
```

## Paso 3

Utilice el objeto Usuario para mostrar las comunicaciones entre ellos.

> MediatorPatternDemo.java

```java
public class MediatorPatternDemo {
   public static void main(String[] args) {
      User robert = new User("Robert");
      User john = new User("John");

      robert.sendMessage("Hi! John!");
      john.sendMessage("Hello! Robert!");
   }
}
```

## Paso 4

Verifique la salida.

```note
Thu Jan 31 16:05:46 IST 2013 [Robert] : Hi! John!
Thu Jan 31 16:05:46 IST 2013 [John] : Hello! Robert!
```

---
:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
