namespace AccountsWebApi.DataTransferObjects.Account;

public class GetAccountDto
{
    public Guid Id { get; set; }
    public DateTime DateCreated { get; set; }
    public string? AccountType { get; set; }
}