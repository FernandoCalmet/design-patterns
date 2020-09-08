# Builder Pattern

El patrón de constructor construye un objeto complejo usando objetos simples y usando un enfoque paso a paso. Este tipo de patrón de diseño se incluye en el patrón de creación, ya que este patrón proporciona una de las mejores formas de crear un objeto.

Una clase Builder construye el objeto final paso a paso. Este constructor es independiente de otros objetos.

## Implementación

Hemos considerado un caso comercial de restaurante de comida rápida donde una comida típica podría ser una hamburguesa y una bebida fría. La hamburguesa puede ser una hamburguesa vegetariana o una hamburguesa de pollo y se empacará con una envoltura. La bebida fría puede ser una coca cola o una pepsi y se envasa en una botella.

Vamos a crear una interfaz de artículo que represente alimentos como hamburguesas y bebidas frías y clases concretas que implementen la interfaz de artículo y una interfaz de embalaje que represente el empaque de artículos alimenticios y clases concretas que implementen la interfaz de embalaje, ya que la hamburguesa se empacaría en envoltorio y bebida fría. sería empaquetado como botella.

Luego creamos una clase Meal con ArrayList of Item y MealBuilder para construir diferentes tipos de objetos Meal combinando Item. BuilderPatternDemo, nuestra clase de demostración utilizará MealBuilder para crear una comida.

![UML Diagram](builder_pattern_uml_diagram.jpg)

## Paso 1

Cree un elemento de interfaz que represente el producto alimenticio y el embalaje.

> Item.java

```java
public interface Item {
   public String name();
   public Packing packing();
   public float price();
}
```

```java
public interface Packing {
   public String pack();
}
```

## Paso 2

Cree clases concretas implementando la interfaz Packing.

> Wrapper.java

```java
public class Wrapper implements Packing {

   @Override
   public String pack() {
      return "Wrapper";
   }
}
```

> Bottle.java

```java
public class Bottle implements Packing {

   @Override
   public String pack() {
      return "Bottle";
   }
}
```

## Paso 3

Cree clases abstractas implementando la interfaz del elemento que proporciona funcionalidades predeterminadas.

> Burger.java

```java
public abstract class Burger implements Item {

   @Override
   public Packing packing() {
      return new Wrapper();
   }

   @Override
   public abstract float price();
}
```

> ColdDrink.java

```java
public abstract class ColdDrink implements Item {

   @Override
   public Packing packing() {
       return new Bottle();
   }

   @Override
   public abstract float price();
}
```

## Paso 4

Crear clases concretas que amplíen las clases de hamburguesas y bebidas frías

> VegBurger.java

```java
public class VegBurger extends Burger {

   @Override
   public float price() {
      return 25.0f;
   }

   @Override
   public String name() {
      return "Veg Burger";
   }
}
```

> ChickenBurger.java

```java
public class ChickenBurger extends Burger {

   @Override
   public float price() {
      return 50.5f;
   }

   @Override
   public String name() {
      return "Chicken Burger";
   }
}
```

> Coke.java

```java
public class Coke extends ColdDrink {

   @Override
   public float price() {
      return 30.0f;
   }

   @Override
   public String name() {
      return "Coke";
   }
}
```

> Pepsi.java

```java
public class Pepsi extends ColdDrink {

   @Override
   public float price() {
      return 35.0f;
   }

   @Override
   public String name() {
      return "Pepsi";
   }
}
```

## Paso 5

Cree una clase Meal con objetos Item definidos anteriormente.

> Meal.java

```java
import java.util.ArrayList;
import java.util.List;

public class Meal {
   private List<Item> items = new ArrayList<Item>();

   public void addItem(Item item){
      items.add(item);
   }

   public float getCost(){
      float cost = 0.0f;

      for (Item item : items) {
         cost += item.price();
      }
      return cost;
   }

   public void showItems(){

      for (Item item : items) {
         System.out.print("Item : " + item.name());
         System.out.print(", Packing : " + item.packing().pack());
         System.out.println(", Price : " + item.price());
      }
   }
}
```

## Paso 6

Cree una clase MealBuilder, la clase de constructor real responsable de crear objetos Meal.

> MealBuilder.java

```java
public class MealBuilder {

   public Meal prepareVegMeal (){
      Meal meal = new Meal();
      meal.addItem(new VegBurger());
      meal.addItem(new Coke());
      return meal;
   }

   public Meal prepareNonVegMeal (){
      Meal meal = new Meal();
      meal.addItem(new ChickenBurger());
      meal.addItem(new Pepsi());
      return meal;
   }
}
```

## Paso 7

BuiderPatternDemo usa MealBuider para demostrar el patrón del constructor.

> BuilderPatternDemo.java

```java
public class BuilderPatternDemo {
   public static void main(String[] args) {

      MealBuilder mealBuilder = new MealBuilder();

      Meal vegMeal = mealBuilder.prepareVegMeal();
      System.out.println("Veg Meal");
      vegMeal.showItems();
      System.out.println("Total Cost: " + vegMeal.getCost());

      Meal nonVegMeal = mealBuilder.prepareNonVegMeal();
      System.out.println("\n\nNon-Veg Meal");
      nonVegMeal.showItems();
      System.out.println("Total Cost: " + nonVegMeal.getCost());
   }
}
```

## Paso 8

Verifique la salida.

```note
Veg Meal
Item : Veg Burger, Packing : Wrapper, Price : 25.0
Item : Coke, Packing : Bottle, Price : 30.0
Total Cost: 55.0


Non-Veg Meal
Item : Chicken Burger, Packing : Wrapper, Price : 50.5
Item : Pepsi, Packing : Bottle, Price : 35.0
Total Cost: 85.5
```

---
:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
