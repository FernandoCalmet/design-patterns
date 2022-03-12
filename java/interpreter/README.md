# Interpreter Pattern

El patrón de intérprete proporciona una forma de evaluar la gramática o la expresión del lenguaje. Este tipo de patrón viene bajo un patrón de comportamiento. Este patrón implica implementar una interfaz de expresión que indica interpretar un contexto particular. Este patrón se utiliza en el análisis de SQL, el motor de procesamiento de símbolos, etc.

## Implementación

Vamos a crear una interfaz Expression y clases concretas implementando la interfaz Expression. Se define una clase TerminalExpression que actúa como intérprete principal del contexto en cuestión. Otras clases OrExpression, AndExpression se utilizan para crear expresiones combinacionales.

InterpreterPatternDemo, nuestra clase de demostración, utilizará la clase Expression para crear reglas y demostrar el análisis de expresiones.

![UML Diagram](interpreter_pattern_uml_diagram.jpg)

## Paso 1

Crea una interfaz de expresión.

> Expression.java

```java
public interface Expression {
   public boolean interpret(String context);
}
```

## Paso 2

Cree clases concretas implementando la interfaz anterior.

> TerminalExpression.java

```java
public class TerminalExpression implements Expression {

   private String data;

   public TerminalExpression(String data){
      this.data = data;
   }

   @Override
   public boolean interpret(String context) {

      if(context.contains(data)){
         return true;
      }
      return false;
   }
}
```

> OrExpression.java

```java
public class OrExpression implements Expression {

   private Expression expr1 = null;
   private Expression expr2 = null;

   public OrExpression(Expression expr1, Expression expr2) {
      this.expr1 = expr1;
      this.expr2 = expr2;
   }

   @Override
   public boolean interpret(String context) {
      return expr1.interpret(context) || expr2.interpret(context);
   }
}
```

> AndExpression.java

```java
public class AndExpression implements Expression {

   private Expression expr1 = null;
   private Expression expr2 = null;

   public AndExpression(Expression expr1, Expression expr2) {
      this.expr1 = expr1;
      this.expr2 = expr2;
   }

   @Override
   public boolean interpret(String context) {
      return expr1.interpret(context) && expr2.interpret(context);
   }
}
```

## Paso 3

InterpreterPatternDemo usa la clase Expression para crear reglas y luego analizarlas.

> InterpreterPatternDemo.java

```java
public class InterpreterPatternDemo {

   //Rule: Robert and John are male
   public static Expression getMaleExpression(){
      Expression robert = new TerminalExpression("Robert");
      Expression john = new TerminalExpression("John");
      return new OrExpression(robert, john);
   }

   //Rule: Julie is a married women
   public static Expression getMarriedWomanExpression(){
      Expression julie = new TerminalExpression("Julie");
      Expression married = new TerminalExpression("Married");
      return new AndExpression(julie, married);
   }

   public static void main(String[] args) {
      Expression isMale = getMaleExpression();
      Expression isMarriedWoman = getMarriedWomanExpression();

      System.out.println("John is male? " + isMale.interpret("John"));
      System.out.println("Julie is a married women? " + isMarriedWoman.interpret("Married Julie"));
   }
}
```

## Paso 4

Verifique la salida.

```note
John is male? true
Julie is a married women? true
```

---
:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
