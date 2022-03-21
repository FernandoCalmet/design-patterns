using Pets.Application.Contracts;
using Pets.Application.Models;

namespace Pets.Application.Services;

public class PetService
{
    #region -> Fields

    private readonly IMessageBroker _messageBroker;
    private IPetModel _petModel;

    #endregion -> Fields

    #region -> Constructors

    public PetService(IMessageBroker messageBroker)
    {
        _messageBroker = messageBroker;
        _petModel = new PetModel();
    }

    #endregion -> Constructors

    #region -> Public Methods

    public void Create(string name, DateTime dateOfBirth)
    {
        var petModel = new PetModel
        {
            Id = new Guid(),
            Name = name,
            DateOfBirth = dateOfBirth
        };
        _petModel.Add(petModel);

        foreach (var domainEvent in petModel.DomainEvents)
        {
            _messageBroker.Publish(domainEvent);
        }
    }
    public void Update(Guid uid, string name, DateTime dateOfBirth)
    {
        var petModel = new PetModel
        {
            Id = uid,
            Name = name,
            DateOfBirth = dateOfBirth
        };
        var petToUpdate = _petModel.Edit(petModel);

        foreach (var domainEvent in petToUpdate.DomainEvents)
        {
            _messageBroker.Publish(domainEvent);
        }
    }
    public IEnumerable<PetModel> GetAll()
    {
        return _petModel.GetAll();
    }
    public PetModel? GetSingleById(Guid uid)
    {
        return _petModel.GetSingle(uid);
    }
    public void Delete(Guid uid)
    {
        _petModel.Remove(uid);
    }

    #endregion -> Public Methods     
}
