namespace OrderManagement.Domain.Entities;

public class Order : Entity
{
    public Order(string description, string deliveryAddress, decimal price)
    {
        Description = description;
        DeliveryAddress = deliveryAddress;
        Price = price;
    }

    public string Description { get; private set; } = string.Empty;
    public string DeliveryAddress { get; private set; } = string.Empty;
    public decimal Price { get; private set; }
}
