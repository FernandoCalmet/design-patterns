namespace Pets.Application.Services;

public interface IPetService
{
    void Create(Guid id, string name, DateTime dateOfBirth);
    void Update(Guid id, string name, DateTime dateOfBirth);
    IEnumerable<Pet> GetAll();
    Pet? GetSingleById(Guid id);
    void Delete(Guid id);
}
