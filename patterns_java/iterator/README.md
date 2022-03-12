# Iterator Pattern

El patrón de iterador es un patrón de diseño muy utilizado en el entorno de programación Java y .Net. Este patrón se utiliza para obtener una forma de acceder a los elementos de un objeto de colección de manera secuencial sin necesidad de conocer su representación subyacente.

El patrón de iterador se incluye en la categoría de patrón de comportamiento.

## Implementación

Vamos a crear una interfaz de iterador que narra el método de navegación y una interfaz de contenedor que devuelve el iterador. Las clases concretas que implementen la interfaz Container serán responsables de implementar la interfaz Iterator y usarla

IteratorPatternDemo, nuestra clase de demostración usará NamesRepository, una clase concreta Implementación para imprimir un Names almacenado como una colección en NamesRepository.

![UML Diagram](iterator_pattern_uml_diagram.jpg)

## Paso 1

Crea interfaces.

> Iterator.java

```java
public interface Iterator {
   public boolean hasNext();
   public Object next();
}
```

> Container.java

```java
public interface Container {
   public Iterator getIterator();
}
```

## Paso 2

Cree una clase concreta implementando la interfaz Container. Esta clase tiene una clase interna NameIterator que implementa la interfaz Iterator.

> NameRepository.java

```java
public class NameRepository implements Container {
   public String names[] = {"Robert" , "John" ,"Julie" , "Lora"};

   @Override
   public Iterator getIterator() {
      return new NameIterator();
   }

   private class NameIterator implements Iterator {

      int index;

      @Override
      public boolean hasNext() {

         if(index < names.length){
            return true;
         }
         return false;
      }

      @Override
      public Object next() {

         if(this.hasNext()){
            return names[index++];
         }
         return null;
      }
   }
}
```

## Paso 3

Utilice NameRepository para obtener iteradores e imprimir nombres.

> IteratorPatternDemo.java

```java
public class IteratorPatternDemo {

   public static void main(String[] args) {
      NameRepository namesRepository = new NameRepository();

      for(Iterator iter = namesRepository.getIterator(); iter.hasNext();){
         String name = (String)iter.next();
         System.out.println("Name : " + name);
      }
   }
}
```

## Paso 4

Verifique la salida.

```note
Name : Robert
Name : John
Name : Julie
Name : Lora
```

---
:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
