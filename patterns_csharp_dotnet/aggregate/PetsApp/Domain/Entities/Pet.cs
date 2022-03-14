using PetsApp.Domain.ValueObjects;

namespace PetsApp.Domain.Entities;

public class Pet
{
    public Guid Id { get; init; }
    public PetName Name { get; private set; }
    public PetDateOfBirth DateOfBirth { get; private set; }

    public Pet(PetName name, PetDateOfBirth date)
    {
        Name = name;
        DateOfBirth = date;
    }

    public void SetPetName(PetName name)
    {
        Name = name;
    }

    public void SetPetDateOfBirth(PetDateOfBirth date)
    {
        DateOfBirth = date;
    }

    public override string ToString()
    {
        return $"Id = {Id}, Name = {Name}, Birth = {DateOfBirth.Value}";
    }
}
