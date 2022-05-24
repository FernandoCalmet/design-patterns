namespace AccountsWebApi.Contracts;

public interface IRepositoryWrapper
{
    IOwnerRepository Owner { get; }
    IAccountRepository Account { get; }
    Task SaveAsync();
}