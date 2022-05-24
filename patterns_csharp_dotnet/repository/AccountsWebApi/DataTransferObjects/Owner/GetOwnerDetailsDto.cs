using AccountsWebApi.DataTransferObjects.Account;

namespace AccountsWebApi.DataTransferObjects.Owner;

public class GetOwnerDetailsDto
{
    public Guid Id { get; set; }
    public string Name { get; set; }
    public DateTime DateOfBirth { get; set; }
    public string Address { get; set; }
    public IEnumerable<GetAccountDto>? Accounts { get; set; }
}
