using AccountsWebApi.Contracts;
using AccountsWebApi.Helpers;
using AccountsWebApi.Models;
using Microsoft.EntityFrameworkCore;

namespace AccountsWebApi.Repositories;

public class AccountRepository : RepositoryBase<Account>, IAccountRepository
{
    public AccountRepository(RepositoryContext repositoryContext)
        : base(repositoryContext)
    {
    }

    public async Task<IEnumerable<Account>> GetAllAccounts()
    {
        return await FindAll()
            .OrderBy(ac => ac.DateCreated)
            .ToListAsync();
    }

    public async Task<IEnumerable<Account>> AccountsByOwner(Guid ownerId)
    {
        return await FindByCondition(a => a.OwnerId.Equals(ownerId)).ToListAsync();
    }
}