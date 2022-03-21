namespace Pets.Domain.AggregatesModel.PetAggregate;

public class Pet
{
    public Guid Id { get; init; }
    public PetName Name { get; private set; }
    public PetDateOfBirth DateOfBirth { get; private set; }

    private Pet() { }

    public Pet(Guid id, PetName name, PetDateOfBirth date)
    {
        Id = id;
        SetName(name);
        SetDateOfBirth(date);
    }

    public void SetName(PetName name)
    {
        Name = name;
    }

    public void SetDateOfBirth(PetDateOfBirth date)
    {
        DateOfBirth = date;
    }
}

