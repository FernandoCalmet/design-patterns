namespace Pets.Domain.Entities;

public class Pet
{
    private readonly List<IDomainEvent> Events = new();
    public ICollection<IDomainEvent> DomainEvents => Events;
    public Guid Id { get; init; }
    public PetName Name { get; private set; }
    public PetDateOfBirth DateOfBirth { get; private set; }

    public Pet() { }

    public Pet(PetId id)
    {
        Id = id;
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
