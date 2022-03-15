namespace Pet.Domain.AggregatesModel.PetAggregate;

public class Pet
{
    public Guid Id { get; init; }
    public PetName Name { get; private set; }
    public PetDateOfBirth DateOfBirth { get; private set; }

    public Pet() { }

    public Pet(PetName name, PetDateOfBirth date)
    {
        Name = name;
        DateOfBirth = date;
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

