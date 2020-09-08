# MVC Pattern

MVC Pattern son las siglas de Model-View-Controller Pattern. Este patrón se usa para separar las preocupaciones de la aplicación.

- *Model* - El modelo representa un objeto o JAVA POJO que lleva datos. También puede tener lógica para actualizar el controlador si sus datos cambian.

- *View* - La vista representa la visualización de los datos que contiene el modelo.

- *Controller* - El controlador actúa tanto en el modelo como en la vista. Controla el flujo de datos hacia el objeto del modelo y actualiza la vista cada vez que cambian los datos. Mantiene la vista y el modelo separados.

## Implementación

Vamos a crear un objeto Student que actúa como modelo. StudentView será una clase de vista que puede imprimir los detalles del alumno en la consola y StudentController es la clase controladora responsable de almacenar datos en el objeto Student y actualizar la vista StudentView en consecuencia.

MVCPatternDemo, nuestra clase de demostración, utilizará StudentController para demostrar el uso del patrón MVC.

![UML Diagram](mvc_pattern_uml_diagram.jpg)

## Paso 1

Crear Modelo.

> Student.java

```java
public class Student {
   private String rollNo;
   private String name;

   public String getRollNo() {
      return rollNo;
   }

   public void setRollNo(String rollNo) {
      this.rollNo = rollNo;
   }

   public String getName() {
      return name;
   }

   public void setName(String name) {
      this.name = name;
   }
}
```

## Paso 2

Crear vista.

> StudentView.java

```java
public class StudentView {
   public void printStudentDetails(String studentName, String studentRollNo){
      System.out.println("Student: ");
      System.out.println("Name: " + studentName);
      System.out.println("Roll No: " + studentRollNo);
   }
}
```

## Paso 3

Crear Controlador.

> StudentController.java

```java
public class StudentController {
   private Student model;
   private StudentView view;

   public StudentController(Student model, StudentView view){
      this.model = model;
      this.view = view;
   }

   public void setStudentName(String name){
      model.setName(name);
   }

   public String getStudentName(){
      return model.getName();
   }

   public void setStudentRollNo(String rollNo){
      model.setRollNo(rollNo);
   }

   public String getStudentRollNo(){
      return model.getRollNo();
   }

   public void updateView(){
      view.printStudentDetails(model.getName(), model.getRollNo());
   }
}
```

## Paso 4

Utilice los métodos StudentController para demostrar el uso del patrón de diseño MVC.

> MVCPatternDemo.java

```java
public class MVCPatternDemo {
   public static void main(String[] args) {

      //fetch student record based on his roll no from the database
      Student model  = retriveStudentFromDatabase();

      //Create a view : to write student details on console
      StudentView view = new StudentView();

      StudentController controller = new StudentController(model, view);

      controller.updateView();

      //update model data
      controller.setStudentName("John");

      controller.updateView();
   }

   private static Student retriveStudentFromDatabase(){
      Student student = new Student();
      student.setName("Robert");
      student.setRollNo("10");
      return student;
   }
}
```

## Paso 5

Verifique la salida.

```note
Student:
Name: Robert
Roll No: 10
Student:
Name: John
Roll No: 10
```

---
:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
