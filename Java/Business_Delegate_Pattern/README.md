# Business Delegate Pattern

Business Delegate Pattern is used to decouple presentation tier and business tier. It is basically use to reduce communication or remote lookup functionality to business tier code in presentation tier code. In business tier we have following entities.

- *Client* - Presentation tier code may be JSP, servlet or UI java code.

- *Business Delegate* - A single entry point class for client entities to provide access to Business Service methods.

- *LookUp Service* - Lookup service object is responsible to get relative business implementation and provide business object access to business delegate object.

- *Business Service* - Business Service interface. Concrete classes implement this business service to provide actual business implementation logic.

## Implementation

We are going to create a Client, BusinessDelegate, BusinessService, LookUpService, JMSService and EJBService representing various entities of Business Delegate patterns.

BusinessDelegatePatternDemo, our demo class, will use BusinessDelegate and Client to demonstrate use of Business Delegate pattern.

![UML Diagram](business_delegate_pattern_uml_diagram.jpg)

## Step 1

Create BusinessService Interface.

_BusinessService.java_

```java
public interface BusinessService {
   public void doProcessing();
}
```

## Step 2

Create concrete Service classes.

_EJBService.java_

```java
public class EJBService implements BusinessService {

   @Override
   public void doProcessing() {
      System.out.println("Processing task by invoking EJB Service");
   }
}
```

_JMSService.java_

```java
public class JMSService implements BusinessService {

   @Override
   public void doProcessing() {
      System.out.println("Processing task by invoking JMS Service");
   }
}
```

## Step 3

Create Business Lookup Service.

_BusinessLookUp.java_

```java
public class BusinessLookUp {
   public BusinessService getBusinessService(String serviceType){
   
      if(serviceType.equalsIgnoreCase("EJB")){
         return new EJBService();
      }
      else {
         return new JMSService();
      }
   }
}
```

## Step 4

Create Business Delegate.

_BusinessDelegate.java_

```java
public class BusinessDelegate {
   private BusinessLookUp lookupService = new BusinessLookUp();
   private BusinessService businessService;
   private String serviceType;

   public void setServiceType(String serviceType){
      this.serviceType = serviceType;
   }

   public void doTask(){
      businessService = lookupService.getBusinessService(serviceType);
      businessService.doProcessing();		
   }
}
```

## Step 5

Create Client.

_Client.java_

```java
public class Client {
	
   BusinessDelegate businessService;

   public Client(BusinessDelegate businessService){
      this.businessService  = businessService;
   }

   public void doTask(){		
      businessService.doTask();
   }
}
```

## Step 6

Use BusinessDelegate and Client classes to demonstrate Business Delegate pattern.

_BusinessDelegatePatternDemo.java_

```java
public class BusinessDelegatePatternDemo {
	
   public static void main(String[] args) {

      BusinessDelegate businessDelegate = new BusinessDelegate();
      businessDelegate.setServiceType("EJB");

      Client client = new Client(businessDelegate);
      client.doTask();

      businessDelegate.setServiceType("JMS");
      client.doTask();
   }
}
```

## Step 7

Verify the output.

```
Processing task by invoking EJB Service
Processing task by invoking JMS Service
```

:octocat: [Check more about Design Patterns in my repository.](https://github.com/FernandoCalmet/Design-Patterns)

## Support me ☕💖

<a href='https://ko-fi.com/fernandocalmet' target='_blank'>
  <img height='36' style='border:0px;height:36px;' src='https://az743702.vo.msecnd.net/cdn/kofi3.png?v=2' border='0' alt='Buy Me a Coffee at ko-fi.com' />
</a>
