# Front Controller Pattern

El patrón de diseño del controlador frontal se utiliza para proporcionar un mecanismo de manejo de solicitudes centralizado de modo que todas las solicitudes sean manejadas por un solo controlador. Este controlador puede realizar la autenticación / autorización / registro o seguimiento de la solicitud y luego pasar las solicitudes a los controladores correspondientes. A continuación se muestran las entidades de este tipo de patrón de diseño.

- *Front Controller* - Controlador único para todo tipo de solicitudes que llegan a la aplicación (ya sea basadas en web / basadas en escritorio).

- *Dispatcher* - Front Controller puede usar un objeto dispatcher que puede enviar la solicitud al manejador específico correspondiente.

- *View* - Las vistas son el objeto para el que se realizan las solicitudes.

## Implementación

Vamos a crear un FrontController y Dispatcher para actuar como Front Controller y Dispatcher correspondientemente. HomeView y StudentView representan varias vistas para las cuales las solicitudes pueden llegar al controlador frontal.

FrontControllerPatternDemo, nuestra clase de demostración, utilizará FrontController para demostrar el patrón de diseño del controlador frontal.

![UML Diagram](frontcontroller_pattern_uml_diagram.jpg)

## Paso 1

Crear vistas.

> HomeView.java

```java
public class HomeView {
   public void show(){
      System.out.println("Displaying Home Page");
   }
}
```

> StudentView.java

```java
public class StudentView {
   public void show(){
      System.out.println("Displaying Student Page");
   }
}
```

## Paso 2

Crear despachador.

> Dispatcher.java

```java
public class Dispatcher {
   private StudentView studentView;
   private HomeView homeView;

   public Dispatcher(){
      studentView = new StudentView();
      homeView = new HomeView();
   }

   public void dispatch(String request){
      if(request.equalsIgnoreCase("STUDENT")){
         studentView.show();
      }
      else{
         homeView.show();
      }
   }
}
```

## Paso 3

Crear el FrontController.

> FrontController.java

```java
public class FrontController {

   private Dispatcher dispatcher;

   public FrontController(){
      dispatcher = new Dispatcher();
   }

   private boolean isAuthenticUser(){
      System.out.println("User is authenticated successfully.");
      return true;
   }

   private void trackRequest(String request){
      System.out.println("Page requested: " + request);
   }

   public void dispatchRequest(String request){
      //log each request
      trackRequest(request);

      //authenticate the user
      if(isAuthenticUser()){
         dispatcher.dispatch(request);
      }
   }
}
```

## Paso 4

Utilice FrontController para demostrar el patrón de diseño del controlador frontal.

> FrontControllerPatternDemo.java

```java
public class FrontControllerPatternDemo {
   public static void main(String[] args) {

      FrontController frontController = new FrontController();
      frontController.dispatchRequest("HOME");
      frontController.dispatchRequest("STUDENT");
   }
}
```

## Paso 5

Verifique la salida.

```note
Page requested: HOME
User is authenticated successfully.
Displaying Home Page
Page requested: STUDENT
User is authenticated successfully.
Displaying Student Page
```

---
:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
