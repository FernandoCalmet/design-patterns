namespace Pets.Domain.Events;

public class PetNameChanged : IDomainEvent
{
    public string PetName { get; init; }

    public PetNameChanged(string petName)
    {
        PetName = petName;
    }
}
