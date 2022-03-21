namespace Pets.Domain.AggregatesModel.PetAggregate;

public record PetDateOfBirth
{
    public DateTime Value { get; init; }

    public PetDateOfBirth(DateTime value)
    {
        Validate(value);
        Value = value;
    }

    public static PetDateOfBirth Create(DateTime value)
    {
        return new PetDateOfBirth(value);
    }

    private static void Validate(DateTime value)
    {
        //if (value > DateOnly.FromDateTime(DateTime.Now))
        if (value > DateTime.Now)
        {
            throw new ArgumentOutOfRangeException("Date of birth is not valid.");
        }
    }
}
