namespace Pet.Domain.AggregatesModel.PetAggregate.ValueObjects;

public record PetDateOfBirth
{
    public DateOnly Value { get; init; }

    public PetDateOfBirth(DateOnly value)
    {
        Validate(value);
        Value = value;
    }

    public static PetDateOfBirth Create(DateOnly value)
    {
        return new PetDateOfBirth(value);
    }

    private static void Validate(DateOnly value)
    {
        if (value > DateOnly.FromDateTime(DateTime.Now))
        {
            throw new ArgumentOutOfRangeException("Date of birth is not valid.");
        }
    }
}
