# Command Pattern

El patrón de comando es un patrón de diseño basado en datos y se incluye en la categoría de patrón de comportamiento. Una solicitud se envuelve debajo de un objeto como comando y se pasa al objeto invocador. El objeto invocador busca el objeto apropiado que puede manejar este comando y pasa el comando al objeto correspondiente que ejecuta el comando.

## Implementación

Hemos creado una orden de interfaz que actúa como un comando. Hemos creado una clase de Stock que actúa como una solicitud. Contamos con clases de comando concretas BuyStock y SellStock que implementan la interfaz de pedidos que realizarán el procesamiento real de los comandos. Se crea una clase Broker que actúa como objeto invocador. Puede tomar y realizar pedidos.

El objeto de intermediario utiliza un patrón de comando para identificar qué objeto ejecutará qué comando en función del tipo de comando. CommandPatternDemo, nuestra clase de demostración, utilizará la clase Broker para demostrar el patrón de comando.

![UML Diagram](command_pattern_uml_diagram.jpg)

## Paso 1

Cree una interfaz de comando.

> Order.java

```java
public interface Order {
   void execute();
}
```

## Paso 2

Crea una clase de solicitud.

> Stock.java

```java
public class Stock {

   private String name = "ABC";
   private int quantity = 10;

   public void buy(){
      System.out.println("Stock [ Name: "+name+", Quantity: " + quantity +" ] bought");
   }
   public void sell(){
      System.out.println("Stock [ Name: "+name+", Quantity: " + quantity +" ] sold");
   }
}
```

## Paso 3

Cree clases concretas implementando la interfaz Order.

> BuyStock.java

```java
public class BuyStock implements Order {
   private Stock abcStock;

   public BuyStock(Stock abcStock){
      this.abcStock = abcStock;
   }

   public void execute() {
      abcStock.buy();
   }
}
```

> SellStock.java

```java
public class SellStock implements Order {
   private Stock abcStock;

   public SellStock(Stock abcStock){
      this.abcStock = abcStock;
   }

   public void execute() {
      abcStock.sell();
   }
}
```

## Paso 4

Crea una clase de invocador de comandos.

> Broker.java

```java
import java.util.ArrayList;
import java.util.List;

   public class Broker {
   private List<Order> orderList = new ArrayList<Order>();

   public void takeOrder(Order order){
      orderList.add(order);
   }

   public void placeOrders(){

      for (Order order : orderList) {
         order.execute();
      }
      orderList.clear();
   }
}
```

## Paso 5

Utilice la clase Broker para tomar y ejecutar comandos.

> CommandPatternDemo.java

```java
public class CommandPatternDemo {
   public static void main(String[] args) {
      Stock abcStock = new Stock();

      BuyStock buyStockOrder = new BuyStock(abcStock);
      SellStock sellStockOrder = new SellStock(abcStock);

      Broker broker = new Broker();
      broker.takeOrder(buyStockOrder);
      broker.takeOrder(sellStockOrder);

      broker.placeOrders();
   }
}
```

## Paso 6

Verifique la salida.

```note
Stock [ Name: ABC, Quantity: 10 ] bought
Stock [ Name: ABC, Quantity: 10 ] sold
```

---
:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
