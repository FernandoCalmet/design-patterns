# State Pattern

In State pattern a class behavior changes based on its state. This type of design pattern comes under behavior pattern.

In State pattern, we create objects which represent various states and a context object whose behavior varies as its state object changes.

## Implementation

We are going to create a State interface defining an action and concrete state classes implementing the State interface. Context is a class which carries a State.

StatePatternDemo, our demo class, will use Context and state objects to demonstrate change in Context behavior based on type of state it is in.

![UML Diagram](state_pattern_uml_diagram.jpg)

## Step 1

Create an interface.

_State.java_

```java
public interface State {
   public void doAction(Context context);
}
```

## Step 2

Create concrete classes implementing the same interface.

_StartState.java_

```java
public class StartState implements State {

   public void doAction(Context context) {
      System.out.println("Player is in start state");
      context.setState(this);	
   }

   public String toString(){
      return "Start State";
   }
}
```

_StopState.java_

```java
public class StopState implements State {

   public void doAction(Context context) {
      System.out.println("Player is in stop state");
      context.setState(this);	
   }

   public String toString(){
      return "Stop State";
   }
}
```

## Step 3

Create Context Class.

_Context.java_

```java
public class Context {
   private State state;

   public Context(){
      state = null;
   }

   public void setState(State state){
      this.state = state;		
   }

   public State getState(){
      return state;
   }
}
```

## Step 4

Use the Context to see change in behaviour when State changes.

_StatePatternDemo.java_

```java
public class StatePatternDemo {
   public static void main(String[] args) {
      Context context = new Context();

      StartState startState = new StartState();
      startState.doAction(context);

      System.out.println(context.getState().toString());

      StopState stopState = new StopState();
      stopState.doAction(context);

      System.out.println(context.getState().toString());
   }
}
```

## Step 5

Verify the output.

```
Player is in start state
Start State
Player is in stop state
Stop State
```

:octocat: [Check more about Design Patterns in my repository.](https://github.com/FernandoCalmet/Design-Patterns)

## Support me ☕💖

<a href='https://ko-fi.com/fernandocalmet' target='_blank'>
  <img height='36' style='border:0px;height:36px;' src='https://az743702.vo.msecnd.net/cdn/kofi3.png?v=2' border='0' alt='Buy Me a Coffee at ko-fi.com' />
</a>
