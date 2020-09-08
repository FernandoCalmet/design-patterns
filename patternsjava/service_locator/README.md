# Service Locator Pattern

El patrón de diseño del localizador de servicios se usa cuando queremos ubicar varios servicios usando la búsqueda JNDI. Teniendo en cuenta el alto costo de buscar JNDI para un servicio, el patrón del localizador de servicios hace uso de la técnica de almacenamiento en caché. Por primera vez se requiere un servicio, Service Locator busca en JNDI y almacena en caché el objeto de servicio. Se realizan búsquedas adicionales o el mismo servicio a través de Service Locator en su caché, lo que mejora el rendimiento de la aplicación en gran medida. A continuación se muestran las entidades de este tipo de patrón de diseño.

- *Service* - Servicio real que procesará la solicitud. La referencia de dicho servicio debe consultarse en el servidor JNDI

- *Context / Initial Context* - El contexto JNDI lleva la referencia al servicio utilizado para fines de búsqueda.

- *Service Locator* - Service Locator es un único punto de contacto para obtener servicios mediante búsqueda JNDI almacenando en caché los servicios.

- *Cache* - Cache para almacenar referencias de servicios para reutilizarlos.

- *Client* - El cliente es el objeto que invoca los servicios a través de ServiceLocator.

## Implementación

Vamos a crear un ServiceLocator, InitialContext, Cache, Service ya que varios objetos que representan nuestras entidades, Service1 y Service2 representan servicios concretos.

ServiceLocatorPatternDemo, nuestra clase de demostración, actúa como cliente aquí y utilizará ServiceLocator para demostrar el patrón de diseño del localizador de servicios.

![UML Diagram](servicelocator_pattern_uml_diagram.jpg)

## Paso 1

Crear interfaz de servicio.

> Service.java

```java
public interface Service {
   public String getName();
   public void execute();
}
```

## Paso 2

Crea servicios concretos.

> Service1.java

```java
public class Service1 implements Service {
   public void execute(){
      System.out.println("Executing Service1");
   }

   @Override
   public String getName() {
      return "Service1";
   }
}
```

> Service2.java

```java
public class Service2 implements Service {
   public void execute(){
      System.out.println("Executing Service2");
   }

   @Override
   public String getName() {
      return "Service2";
   }
}
```

## Paso 3

Crear InitialContext para la búsqueda JNDI.

> InitialContext.java

```java
public class InitialContext {
   public Object lookup(String jndiName){

      if(jndiName.equalsIgnoreCase("SERVICE1")){
         System.out.println("Looking up and creating a new Service1 object");
         return new Service1();
      }
      else if (jndiName.equalsIgnoreCase("SERVICE2")){
         System.out.println("Looking up and creating a new Service2 object");
         return new Service2();
      }
      return null;
   }
}
```

## Paso 4

Crear Cache

> Cache.java

```java
import java.util.ArrayList;
import java.util.List;

public class Cache {

   private List<Service> services;

   public Cache(){
      services = new ArrayList<Service>();
   }

   public Service getService(String serviceName){

      for (Service service : services) {
         if(service.getName().equalsIgnoreCase(serviceName)){
            System.out.println("Returning cached  " + serviceName + " object");
            return service;
         }
      }
      return null;
   }

   public void addService(Service newService){
      boolean exists = false;

      for (Service service : services) {
         if(service.getName().equalsIgnoreCase(newService.getName())){
            exists = true;
         }
      }
      if(!exists){
         services.add(newService);
      }
   }
}
```

## Paso 5

Crear localizador de servicios

> ServiceLocator.java

```java
public class ServiceLocator {
   private static Cache cache;

   static {
      cache = new Cache();
   }

   public static Service getService(String jndiName){

      Service service = cache.getService(jndiName);

      if(service != null){
         return service;
      }

      InitialContext context = new InitialContext();
      Service service1 = (Service)context.lookup(jndiName);
      cache.addService(service1);
      return service1;
   }
}
```

## Paso 6

Utilice ServiceLocator para demostrar el patrón de diseño del localizador de servicios.

> ServiceLocatorPatternDemo.java

```java
public class ServiceLocatorPatternDemo {
   public static void main(String[] args) {
      Service service = ServiceLocator.getService("Service1");
      service.execute();
      service = ServiceLocator.getService("Service2");
      service.execute();
      service = ServiceLocator.getService("Service1");
      service.execute();
      service = ServiceLocator.getService("Service2");
      service.execute();
   }
}
```

## Paso 7

Verifique la salida.

```note
Looking up and creating a new Service1 object
Executing Service1
Looking up and creating a new Service2 object
Executing Service2
Returning cached  Service1 object
Executing Service1
Returning cached  Service2 object
Executing Service2
```

---
:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
