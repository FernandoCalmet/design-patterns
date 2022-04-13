namespace Pets.Domain.ValueObjects;

public record PetName
{
    public string Value { get; init; }

    internal PetName(string value)
    {
        Value = value;
    }

    public static PetName Create(string value)
    {
        Validate(value);
        return new PetName(value);
    }

    public static implicit operator string(PetName name)
    {
        return name.Value;
    }

    private static void Validate(string value)
    {
        if (value.Length > 20)
        {
            throw new ArgumentOutOfRangeException(nameof(value), "Name must not be longer than 20 characters");
        }
    }
}
