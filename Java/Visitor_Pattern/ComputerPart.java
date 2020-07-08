package Java.Visitor_Pattern;

public interface ComputerPart {
    public void accept(ComputerPartVisitor computerPartVisitor);
}