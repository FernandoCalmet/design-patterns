namespace Pets.Domain.Events;

public class PetDateOfBirthChanged : IDomainEvent
{
    public DateTime PetDateOfBirth { get; init; }
    public PetDateOfBirthChanged(DateTime petDateOfBirth) { PetDateOfBirth = petDateOfBirth; }
}
