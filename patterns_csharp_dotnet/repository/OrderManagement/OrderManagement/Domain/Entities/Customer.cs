namespace OrderManagement.Domain.Entities;

public class Customer : Entity
{
    public string FirstName { get; set; } = string.Empty;
    public string LastName { get; set; } = string.Empty;
}
