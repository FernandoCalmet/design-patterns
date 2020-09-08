# Intercepting Filter Pattern

El patrón de diseño del filtro de interceptación se utiliza cuando queremos hacer un preprocesamiento / posprocesamiento con la solicitud o respuesta de la aplicación. Los filtros se definen y aplican en la solicitud antes de pasar la solicitud a la aplicación de destino real. Los filtros pueden realizar la autenticación / autorización / registro o seguimiento de la solicitud y luego pasar las solicitudes a los controladores correspondientes. A continuación se muestran las entidades de este tipo de patrón de diseño.

- *Filter* - Filtro que realizará cierta tarea antes o después de la ejecución de la solicitud por parte del controlador de solicitudes.

- *Filter Chain* - Filter Chain lleva varios filtros y ayuda a ejecutarlos en un orden definido en el objetivo.

- *Target* - El objeto de destino es el controlador de solicitudes

- *Filter Manager* - El administrador de filtros administra los filtros y la cadena de filtros.

- *Client* - El cliente es el objeto que envía la solicitud al objeto de destino.

## Implementación

Vamos a crear un FilterChain, FilterManager, Target, Client como varios objetos que representan nuestras entidades. AuhenticationFilter y DebugFilter representan filtros concretos.

InterceptingFilterDemo, nuestra clase de demostración, utilizará Client para demostrar el patrón de diseño de filtro de interceptación.

![UML Diagram](interceptingfilter_pattern_uml_diagram.jpg)

## Paso 1

Crear interfaz de filtro.

> Filter.java

```java
public interface Filter {
   public void execute(String request);
}
```

## Paso 2

Crear filtros concretos.

> AuthenticationFilter.java

```java
public class AuthenticationFilter implements Filter {
   public void execute(String request){
      System.out.println("Authenticating request: " + request);
   }
}
```

> DebugFilter.java

```java
public class DebugFilter implements Filter {
   public void execute(String request){
      System.out.println("request log: " + request);
   }
}
```

## Paso 3

Crear objetivo

> Target.java

```java
public class Target {
   public void execute(String request){
      System.out.println("Executing request: " + request);
   }
}
```

## Paso 4

Crear cadena de filtros.

> FilterChain.java

```java
import java.util.ArrayList;
import java.util.List;

public class FilterChain {
   private List<Filter> filters = new ArrayList<Filter>();
   private Target target;

   public void addFilter(Filter filter){
      filters.add(filter);
   }

   public void execute(String request){
      for (Filter filter : filters) {
         filter.execute(request);
      }
      target.execute(request);
   }

   public void setTarget(Target target){
      this.target = target;
   }
}
```

## Paso 5

Crear administrador de filtros.

> FilterManager.java

```java
public class FilterManager {
   FilterChain filterChain;

   public FilterManager(Target target){
      filterChain = new FilterChain();
      filterChain.setTarget(target);
   }
   public void setFilter(Filter filter){
      filterChain.addFilter(filter);
   }

   public void filterRequest(String request){
      filterChain.execute(request);
   }
}
```

## Paso 6

Crear Cliente.

> Client.java

```java
public class Client {
   FilterManager filterManager;

   public void setFilterManager(FilterManager filterManager){
      this.filterManager = filterManager;
   }

   public void sendRequest(String request){
      filterManager.filterRequest(request);
   }
}
```

## Paso 7

Utilice el cliente para demostrar el patrón de diseño de filtro de interceptación.

> InterceptingFilterDemo.java

```java
public class InterceptingFilterDemo {
   public static void main(String[] args) {
      FilterManager filterManager = new FilterManager(new Target());
      filterManager.setFilter(new AuthenticationFilter());
      filterManager.setFilter(new DebugFilter());

      Client client = new Client();
      client.setFilterManager(filterManager);
      client.sendRequest("HOME");
   }
}
```

## Paso 8

Verifique la salida.

```note
Authenticating request: HOME
request log: HOME
Executing request: HOME
```

---
:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
