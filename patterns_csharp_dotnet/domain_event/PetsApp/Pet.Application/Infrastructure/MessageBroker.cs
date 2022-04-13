namespace Pets.Application.Services;

public class MessageBroker : IMessageBroker
{
    public bool Publish(IDomainEvent domainEvent)
    {
        return true; //just for test
    }
}
