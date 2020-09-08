# Template Pattern

En el patrón de plantilla, una clase abstracta expone formas / plantillas definidas para ejecutar sus métodos. Sus subclases pueden anular el método Implementación según sea necesario, pero la invocación debe ser de la misma manera que la definida por una clase abstracta. Este patrón se incluye en la categoría de patrón de comportamiento.

## Implementación

Vamos a crear una clase abstracta de Juego que defina operaciones con un método de plantilla configurado para ser final para que no se pueda anular. El críquet y el fútbol son clases concretas que amplían el juego y anulan sus métodos.

TemplatePatternDemo, nuestra clase de demostración, usará Game para demostrar el uso del patrón de plantilla.

![UML Diagram](template_pattern_uml_diagram.jpg)

## Paso 1

Cree una clase abstracta con un método de plantilla que sea definitivo.

> Game.java

```java
public abstract class Game {
   abstract void initialize();
   abstract void startPlay();
   abstract void endPlay();

   //template method
   public final void play(){

      //initialize the game
      initialize();

      //start game
      startPlay();

      //end game
      endPlay();
   }
}
```

## Paso 2

Cree clases concretas ampliando la clase anterior.

> Cricket.java

```java
public class Cricket extends Game {

   @Override
   void endPlay() {
      System.out.println("Cricket Game Finished!");
   }

   @Override
   void initialize() {
      System.out.println("Cricket Game Initialized! Start playing.");
   }

   @Override
   void startPlay() {
      System.out.println("Cricket Game Started. Enjoy the game!");
   }
}
```

> Football.java

```java
public class Football extends Game {

   @Override
   void endPlay() {
      System.out.println("Football Game Finished!");
   }

   @Override
   void initialize() {
      System.out.println("Football Game Initialized! Start playing.");
   }

   @Override
   void startPlay() {
      System.out.println("Football Game Started. Enjoy the game!");
   }
}
```

## Paso 3

Utilice el método de plantilla del Juego play () para demostrar una forma definida de jugar.

> TemplatePatternDemo.java

```java
public class TemplatePatternDemo {
   public static void main(String[] args) {

      Game game = new Cricket();
      game.play();
      System.out.println();
      game = new Football();
      game.play();
   }
}
```

## Paso 4

Verifique la salida.

```note
Cricket Game Initialized! Start playing.
Cricket Game Started. Enjoy the game!
Cricket Game Finished!

Football Game Initialized! Start playing.
Football Game Started. Enjoy the game!
Football Game Finished!
```

---
:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
