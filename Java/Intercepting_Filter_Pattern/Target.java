package Java.Intercepting_Filter_Pattern;

public class Target {
    public void execute(String request) {
        System.out.println("Executing request: " + request);
    }
}