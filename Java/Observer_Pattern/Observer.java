package Java.Observer_Pattern;

public abstract class Observer {
    protected Subject subject;

    public abstract void update();
}