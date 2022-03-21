using Pets.Application.Contracts;
using Pets.Domain.Events;

namespace Pets.Application.Services;

public class MessageBrokerService : IMessageBroker
{
    public bool Publish(IDomainEvent domainEvent)
    {
        return true; //just for test
    }
}
