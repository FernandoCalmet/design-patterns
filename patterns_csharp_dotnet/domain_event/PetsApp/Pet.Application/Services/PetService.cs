namespace Pets.Application.Services;

public class PetService : IPetService
{
    private readonly IMessageBroker _messageBroker;
    private readonly List<Pet> _pets;

    public PetService(IMessageBroker messageBroker)
    {
        _messageBroker = messageBroker;
        _pets = new List<Pet>();
    }

    public void Create(Guid id, string name, DateTime dateOfBirth)
    {
        var pet = new Pet(PetId.Create(id));
        pet.SetName(PetName.Create(name));
        pet.SetDateOfBirth(PetDateOfBirth.Create(dateOfBirth));
        _pets.Add(pet);

        foreach (var domainEvent in pet.DomainEvents)
        {
            _messageBroker.Publish(domainEvent);
        }
    }
    public void Update(Guid id, string name, DateTime dateOfBirth)
    {
        var pet = _pets.FirstOrDefault(p => p.Id == id);
        pet.SetName(PetName.Create(name));
        pet.SetDateOfBirth(PetDateOfBirth.Create(dateOfBirth));

        foreach (var domainEvent in pet.DomainEvents)
        {
            _messageBroker.Publish(domainEvent);
        }
    }
    public IEnumerable<Pet> GetAll()
    {
        return _pets;
    }
    public Pet? GetSingleById(Guid id)
    {
        return _pets.FirstOrDefault(p => p.Id == id);
    }
    public void Delete(Guid id)
    {
        var pet = _pets.FirstOrDefault(p => p.Id == id);
        _pets.Remove(pet);
    }
}
