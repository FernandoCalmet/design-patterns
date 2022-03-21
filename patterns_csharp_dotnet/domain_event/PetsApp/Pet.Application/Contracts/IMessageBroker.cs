using Pets.Domain.Events;

namespace Pets.Application.Contracts;

public interface IMessageBroker
{
    bool Publish(IDomainEvent domainEvent);
}
