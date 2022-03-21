using Pets.Application.Models;

namespace Pets.Application.Contracts;

public interface IPetService
{
    void Create(string name, DateTime dateOfBirth);
    void Update(Guid uid, string name, DateTime dateOfBirth);
    IEnumerable<PetModel> GetAll();
    PetModel? GetSingleById(Guid uid);
    void Delete(Guid uid);
}
