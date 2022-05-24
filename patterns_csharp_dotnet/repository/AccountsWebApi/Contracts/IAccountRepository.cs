using AccountsWebApi.Models;

namespace AccountsWebApi.Contracts;

public interface IAccountRepository : IRepositoryBase<Account>
{
    Task<IEnumerable<Account>> GetAllAccounts();
    Task<IEnumerable<Account>> AccountsByOwner(Guid ownerId);
}