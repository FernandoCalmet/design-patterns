using AccountsWebApi.Models;

namespace AccountsWebApi.Contracts;

public interface IOwnerRepository : IRepositoryBase<Owner>
{
    Task<IEnumerable<Owner>> GetAllOwners();
    Task<Owner> GetOwnerById(Guid ownerId);
    Task<Owner> GetOwnerWithDetails(Guid ownerId);
    void CreateOwner(Owner owner);
    void UpdateOwner(Owner owner);
    void DeleteOwner(Owner owner);
}
