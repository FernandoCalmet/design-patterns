using Pets.Domain.Events;

namespace Pets.Domain.AggregatesModel.PetAggregate;

public class Pet
{
    private List<IDomainEvent> Events = new();
    public ICollection<IDomainEvent> DomainEvents => Events;
    public Guid Id { get; init; }
    public PetName Name { get; private set; }
    public PetDateOfBirth DateOfBirth { get; private set; }

    private Pet() { }

    public Pet(PetName petName, PetDateOfBirth petDateOfBirth)
    {
        SetName(petName);
        SetDateOfBirth(petDateOfBirth);
    }

    public void SetName(PetName name)
    {
        Name = name;
        var nameEvent = new PetNameChanged(name.Value);
        Events.Add(nameEvent);
    }

    public void SetDateOfBirth(PetDateOfBirth date)
    {
        DateOfBirth = date;
        var dateOfBirthEvent = new PetDateOfBirthChanged(date.Value);
        Events.Add(dateOfBirthEvent);
    }
}
