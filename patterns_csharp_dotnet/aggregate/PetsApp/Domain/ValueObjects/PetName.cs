namespace PetsApp.Domain.ValueObjects
{
    public record PetName
    {
        public string Value { get; init; }

        internal PetName(string value)
        {
            Validate(value);
            Value = value;
        }

        public static PetName Create(string value)
        {
            return new PetName(value);
        }

        private static void Validate(string value)
        {
            if (value.Length > 50)
            {
                throw new ArgumentOutOfRangeException("Name must not be more than 50 characters.");
            }
        }
    }
}