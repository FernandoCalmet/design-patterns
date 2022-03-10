# Chain of Responsibility Pattern

Como sugiere el nombre, el patrón de cadena de responsabilidad crea una cadena de objetos receptores para una solicitud. Este patrón desacopla al remitente y al receptor de una solicitud según el tipo de solicitud. Este patrón viene bajo patrones de comportamiento.

En este patrón, normalmente cada receptor contiene una referencia a otro receptor. Si un objeto no puede manejar la solicitud, pasa la misma al siguiente receptor y así sucesivamente.

## Implementación

Hemos creado una clase abstracta AbstractLogger con un nivel de registro. Luego, hemos creado tres tipos de registradores ampliando el AbstractLogger. Cada registrador verifica el nivel del mensaje a su nivel e imprime en consecuencia; de lo contrario, no imprime y pasa el mensaje al siguiente registrador.

![UML Diagram](chain_pattern_uml_diagram.jpg)

## Paso 1

Cree una clase de registrador abstracto.

> AbstractLogger.java

```java
public abstract class AbstractLogger {
   public static int INFO = 1;
   public static int DEBUG = 2;
   public static int ERROR = 3;

   protected int level;

   //next element in chain or responsibility
   protected AbstractLogger nextLogger;

   public void setNextLogger(AbstractLogger nextLogger){
      this.nextLogger = nextLogger;
   }

   public void logMessage(int level, String message){
      if(this.level <= level){
         write(message);
      }
      if(nextLogger !=null){
         nextLogger.logMessage(level, message);
      }
   }

   abstract protected void write(String message);

}
```

## Paso 2

Crea clases concretas ampliando el registrador.

> ConsoleLogger.java

```java
public class ConsoleLogger extends AbstractLogger {

   public ConsoleLogger(int level){
      this.level = level;
   }

   @Override
   protected void write(String message) {
      System.out.println("Standard Console::Logger: " + message);
   }
}
```

> ErrorLogger.java

```java
public class ErrorLogger extends AbstractLogger {

   public ErrorLogger(int level){
      this.level = level;
   }

   @Override
   protected void write(String message) {
      System.out.println("Error Console::Logger: " + message);
   }
}
```

> FileLogger.java

```java
public class FileLogger extends AbstractLogger {

   public FileLogger(int level){
      this.level = level;
   }

   @Override
   protected void write(String message) {
      System.out.println("File::Logger: " + message);
   }
}
```

## Paso 3

Crea diferentes tipos de registradores. Asígneles niveles de error y configure el siguiente registrador en cada registrador. El siguiente registrador en cada registrador representa la parte de la cadena.

> ChainPatternDemo.java

```java
public class ChainPatternDemo {

   private static AbstractLogger getChainOfLoggers(){

      AbstractLogger errorLogger = new ErrorLogger(AbstractLogger.ERROR);
      AbstractLogger fileLogger = new FileLogger(AbstractLogger.DEBUG);
      AbstractLogger consoleLogger = new ConsoleLogger(AbstractLogger.INFO);

      errorLogger.setNextLogger(fileLogger);
      fileLogger.setNextLogger(consoleLogger);

      return errorLogger;
   }

   public static void main(String[] args) {
      AbstractLogger loggerChain = getChainOfLoggers();

      loggerChain.logMessage(AbstractLogger.INFO,
         "This is an information.");

      loggerChain.logMessage(AbstractLogger.DEBUG,
         "This is an debug level information.");

      loggerChain.logMessage(AbstractLogger.ERROR,
         "This is an error information.");
   }
}
```

## Paso 4

Verifique la salida.

```note
Standard Console::Logger: This is an information.
File::Logger: This is an debug level information.
Standard Console::Logger: This is an debug level information.
Error Console::Logger: This is an error information.
File::Logger: This is an error information.
Standard Console::Logger: This is an error information.
```

---
:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
