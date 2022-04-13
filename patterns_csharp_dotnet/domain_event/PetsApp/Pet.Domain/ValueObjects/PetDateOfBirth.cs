namespace Pets.Domain.ValueObjects;

public record PetDateOfBirth
{
    public DateTime Value { get; init; }

    internal PetDateOfBirth(DateTime value)
    {
        Value = value;
    }

    public static PetDateOfBirth Create(DateTime value)
    {
        Validate(value);
        return new PetDateOfBirth(value);
    }

    public static implicit operator DateTime(PetDateOfBirth petDateOfBirth)
    {
        return petDateOfBirth.Value;
    }

    private static void Validate(DateTime value)
    {
        if (value > DateTime.UtcNow)
        {
            throw new ArgumentOutOfRangeException(nameof(value), "Date must not be greater than today");
        }
    }
}
