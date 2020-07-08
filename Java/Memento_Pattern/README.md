# Mediator Pattern

Memento pattern is used to restore state of an object to a previous state. Memento pattern falls under behavioral pattern category.

## Implementation

Memento pattern uses three actor classes. Memento contains state of an object to be restored. Originator creates and stores states in Memento objects and Caretaker object is responsible to restore object state from Memento. We have created classes Memento, Originator and CareTaker.

MementoPatternDemo, our demo class, will use CareTaker and Originator objects to show restoration of object states.

![UML Diagram](memento_pattern_uml_diagram.jpg)

## Step 1

Create Memento class.

_Memento.java_

```java
public class Memento {
   private String state;

   public Memento(String state){
      this.state = state;
   }

   public String getState(){
      return state;
   }	
}
```

## Step 2

Create Originator class

_Originator.java_

```java
public class Originator {
   private String state;

   public void setState(String state){
      this.state = state;
   }

   public String getState(){
      return state;
   }

   public Memento saveStateToMemento(){
      return new Memento(state);
   }

   public void getStateFromMemento(Memento memento){
      state = memento.getState();
   }
}
```

## Step 3

Create CareTaker class

_CareTaker.java_

```java
import java.util.ArrayList;
import java.util.List;

public class CareTaker {
   private List<Memento> mementoList = new ArrayList<Memento>();

   public void add(Memento state){
      mementoList.add(state);
   }

   public Memento get(int index){
      return mementoList.get(index);
   }
}
```

## Step 4

Use CareTaker and Originator objects.

_MementoPatternDemo.java_

```java
public class MementoPatternDemo {
   public static void main(String[] args) {
   
      Originator originator = new Originator();
      CareTaker careTaker = new CareTaker();
      
      originator.setState("State #1");
      originator.setState("State #2");
      careTaker.add(originator.saveStateToMemento());
      
      originator.setState("State #3");
      careTaker.add(originator.saveStateToMemento());
      
      originator.setState("State #4");
      System.out.println("Current State: " + originator.getState());		
      
      originator.getStateFromMemento(careTaker.get(0));
      System.out.println("First saved State: " + originator.getState());
      originator.getStateFromMemento(careTaker.get(1));
      System.out.println("Second saved State: " + originator.getState());
   }
}
```

## Step 5

Verify the output.

```
Current State: State #4
First saved State: State #2
Second saved State: State #3
```

:octocat: [Check more about Design Patterns in my repository.](https://github.com/FernandoCalmet/Design-Patterns)

## Support me ☕💖

<a href='https://ko-fi.com/fernandocalmet' target='_blank'>
  <img height='36' style='border:0px;height:36px;' src='https://az743702.vo.msecnd.net/cdn/kofi3.png?v=2' border='0' alt='Buy Me a Coffee at ko-fi.com' />
</a>
