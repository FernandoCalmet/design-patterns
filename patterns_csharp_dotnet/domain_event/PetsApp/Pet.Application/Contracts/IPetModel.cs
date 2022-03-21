using Pets.Application.Models;
using Pets.Domain.AggregatesModel.PetAggregate;

namespace Pets.Application.Contracts;

public interface IPetModel
{
    void Add(PetModel petModel);
    Pet? Edit(PetModel petModel);
    void Remove(Guid uid);
    PetModel? GetSingle(Guid uid);
    IEnumerable<PetModel> GetAll();
}
