using AccountsWebApi.Contracts;
using AccountsWebApi.Helpers;
using AccountsWebApi.Models;
using Microsoft.EntityFrameworkCore;

namespace AccountsWebApi.Repositories;

public class OwnerRepository : RepositoryBase<Owner>, IOwnerRepository
{
    public OwnerRepository(RepositoryContext repositoryContext)
        : base(repositoryContext)
    {
    }

    public async Task<IEnumerable<Owner>> GetAllOwners()
    {
        return await FindAll()
            .OrderBy(ow => ow.Name)
            .ToListAsync();
    }

    public async Task<Owner> GetOwnerById(Guid ownerId)
    {
        return await FindByCondition(owner => owner.Id.Equals(ownerId))
                .FirstOrDefaultAsync();
    }

    public async Task<Owner> GetOwnerWithDetails(Guid ownerId)
    {
        return await FindByCondition(owner => owner.Id.Equals(ownerId))
            .Include(ac => ac.Accounts)
            .FirstOrDefaultAsync();
    }

    public void CreateOwner(Owner owner)
    {
        Create(owner);
    }

    public void UpdateOwner(Owner owner)
    {
        Update(owner);
    }

    public void DeleteOwner(Owner owner)
    {
        Delete(owner);
    }
}