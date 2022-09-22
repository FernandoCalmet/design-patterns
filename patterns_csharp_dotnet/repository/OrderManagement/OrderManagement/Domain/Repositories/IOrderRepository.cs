using OrderManagement.Domain.Entities;

namespace OrderManagement.Domain.Repositories;

public interface IOrderRepository : IRepository<Order>
{
    Order? GetTheMostExpensive();
}