# Data Transfer Object Pattern

El patrón Transferir objeto se utiliza cuando queremos pasar datos con múltiples atributos en una sola toma de cliente a servidor. El objeto de transferencia también se conoce como objeto de valor. Transfer Object es una clase POJO simple que tiene métodos getter / setter y es serializable para que pueda transferirse a través de la red. No tiene ningún comportamiento. La clase de negocio del lado del servidor normalmente obtiene datos de la base de datos y llena el POJO y lo envía al cliente o lo pasa por valor. Para el cliente, el objeto de transferencia es de solo lectura. El cliente puede crear su propio objeto de transferencia y pasarlo al servidor para actualizar los valores en la base de datos de una sola vez. A continuación se muestran las entidades de este tipo de patrón de diseño.

- *Business Object* - Business Service llena el Transfer Object con datos.

- *Transfer Object* - POJO simple que tiene métodos para establecer / obtener atributos únicamente.

- *Client* - el cliente solicita o envía el objeto de transferencia al objeto comercial.

## Implementación

Vamos a crear un StudentBO como Business Object, Student como Transfer Object que representa nuestras entidades.

TransferObjectPatternDemo, nuestra clase de demostración, actúa como cliente aquí y utilizará StudentBO y Student para demostrar Transfer Object Design Pattern.

![UML Diagram](transferobject_pattern_uml_diagram.jpg)

## Paso 1

Crear objeto de transferencia.

> StudentVO.java

```java
public class StudentVO {
   private String name;
   private int rollNo;

   StudentVO(String name, int rollNo){
      this.name = name;
      this.rollNo = rollNo;
   }

   public String getName() {
      return name;
   }

   public void setName(String name) {
      this.name = name;
   }

   public int getRollNo() {
      return rollNo;
   }

   public void setRollNo(int rollNo) {
      this.rollNo = rollNo;
   }
}
```

## Paso 2

Crear objeto comercial.

> StudentBO.java

```java
import java.util.ArrayList;
import java.util.List;

public class StudentBO {

   //list is working as a database
   List<StudentVO> students;

   public StudentBO(){
      students = new ArrayList<StudentVO>();
      StudentVO student1 = new StudentVO("Robert",0);
      StudentVO student2 = new StudentVO("John",1);
      students.add(student1);
      students.add(student2);
   }
   public void deleteStudent(StudentVO student) {
      students.remove(student.getRollNo());
      System.out.println("Student: Roll No " + student.getRollNo() + ", deleted from database");
   }

   //retrive list of students from the database
   public List<StudentVO> getAllStudents() {
      return students;
   }

   public StudentVO getStudent(int rollNo) {
      return students.get(rollNo);
   }

   public void updateStudent(StudentVO student) {
      students.get(student.getRollNo()).setName(student.getName());
      System.out.println("Student: Roll No " + student.getRollNo() +", updated in the database");
   }
}
```

## Paso 3

Utilice StudentBO para demostrar el patrón de diseño de objetos de transferencia.

> TransferObjectPatternDemo.java

```java
public class TransferObjectPatternDemo {
   public static void main(String[] args) {
      StudentBO studentBusinessObject = new StudentBO();

      //print all students
      for (StudentVO student : studentBusinessObject.getAllStudents()) {
         System.out.println("Student: [RollNo : " + student.getRollNo() + ", Name : " + student.getName() + " ]");
      }

      //update student
      StudentVO student = studentBusinessObject.getAllStudents().get(0);
      student.setName("Michael");
      studentBusinessObject.updateStudent(student);

      //get the student
      student = studentBusinessObject.getStudent(0);
      System.out.println("Student: [RollNo : " + student.getRollNo() + ", Name : " + student.getName() + " ]");
   }
}
```

## Paso 4

Verifique la salida.

```note
Student: [RollNo : 0, Name : Robert ]
Student: [RollNo : 1, Name : John ]
Student: Roll No 0, updated in the database
Student: [RollNo : 0, Name : Michael ]
```

---
:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
