namespace Pets.Domain.Exceptions;

public class PetDomainException : Exception
{
    /// <summary>
    /// Exception type for domain exceptions
    /// </summary>
    public PetDomainException() { }

    public PetDomainException(string message)
        : base(message)
    { }

    public PetDomainException(string message, Exception innerException)
        : base(message, innerException)
    { }
}