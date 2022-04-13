namespace Pets.Application.Infrastructure;

public interface IMessageBroker
{
    bool Publish(IDomainEvent domainEvent);
}
