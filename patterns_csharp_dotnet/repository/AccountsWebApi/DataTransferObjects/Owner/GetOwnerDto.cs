namespace AccountsWebApi.DataTransferObjects.Owner;

public class GetOwnerDto
{
    public Guid Id { get; set; }
    public string? Name { get; set; }
    public DateTime DateOfBirth { get; set; }
    public string? Address { get; set; }
}
