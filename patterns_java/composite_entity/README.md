# Composite Entity Pattern

El patrón de entidad compuesta se utiliza en el mecanismo de persistencia de EJB. Una entidad compuesta es un bean de entidad EJB que representa un gráfico de objetos. Cuando se actualiza una entidad compuesta, los beans de objetos dependientes internamente se actualizan automáticamente al ser administrados por el bean de entidad EJB. A continuación se muestran los participantes en Composite Entity Bean.

- *Composite Entity* - Es el bean de entidad principal. Puede ser de grano grueso o puede contener un objeto de grano grueso que se utilizará con fines de persistencia.

- *Coarse-Grained Object* - Este objeto contiene objetos dependientes. Tiene su propio ciclo de vida y también gestiona el ciclo de vida de los objetos dependientes.

- *Dependent Object* - El objeto dependiente es un objeto que depende de un objeto de grano grueso para su ciclo de vida de persistencia.

- *Strategies* - Estrategias representa cómo implementar una entidad compuesta.

## Implementación

Vamos a crear un objeto CompositeEntity actuando como CompositeEntity. CoarseGrainedObject será una clase que contiene objetos dependientes. CompositeEntityPatternDemo, nuestra clase de demostración utilizará la clase Client para demostrar el uso del patrón de entidad compuesta.

![UML Diagram](compositeentity_pattern_uml_diagram.jpg)

## Paso 1

Cree objetos dependientes.

> DependentObject1.java

```java
public class DependentObject1 {

   private String data;

   public void setData(String data){
      this.data = data;
   }

   public String getData(){
      return data;
   }
}
```

> DependentObject2.java

```java
public class DependentObject2 {

   private String data;

   public void setData(String data){
      this.data = data;
   }

   public String getData(){
      return data;
   }
}
```

## Paso 2

Crear objeto de grano grueso.

> CoarseGrainedObject.java

```java
public class CoarseGrainedObject {
   DependentObject1 do1 = new DependentObject1();
   DependentObject2 do2 = new DependentObject2();

   public void setData(String data1, String data2){
      do1.setData(data1);
      do2.setData(data2);
   }

   public String[] getData(){
      return new String[] {do1.getData(),do2.getData()};
   }
}
```

## Paso 3

Crear entidad compuesta.

> CompositeEntity.java

```java
public class CompositeEntity {
   private CoarseGrainedObject cgo = new CoarseGrainedObject();

   public void setData(String data1, String data2){
      cgo.setData(data1, data2);
   }

   public String[] getData(){
      return cgo.getData();
   }
}
```

## Paso 4

Cree una clase de cliente para usar la entidad compuesta.

> Client.java

```java
public class Client {
   private CompositeEntity compositeEntity = new CompositeEntity();

   public void printData(){

      for (int i = 0; i < compositeEntity.getData().length; i++) {
         System.out.println("Data: " + compositeEntity.getData()[i]);
      }
   }

   public void setData(String data1, String data2){
      compositeEntity.setData(data1, data2);
   }
}
```

## Paso 5

Utilice el cliente para demostrar el uso del patrón de diseño de la entidad compuesta.

> CompositeEntityPatternDemo.java

```java
public class CompositeEntityPatternDemo {
   public static void main(String[] args) {

       Client client = new Client();
       client.setData("Test", "Data");
       client.printData();
       client.setData("Second Test", "Data1");
       client.printData();
   }
}
```

## Paso 6

Verifique la salida.

```note
Data: Test
Data: Data
Data: Second Test
Data: Data1
```

---
:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
