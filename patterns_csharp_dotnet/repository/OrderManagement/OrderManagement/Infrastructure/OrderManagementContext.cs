using Microsoft.EntityFrameworkCore;
using OrderManagement.Domain.Entities;

namespace OrderManagement.Infrastructure;

public class OrderManagementContext : DbContext
{
    public OrderManagementContext(DbContextOptions options) : base(options)
    {
    }

    public DbSet<Order> Orders => Set<Order>();
    public DbSet<Customer> Customers => Set<Customer>();
}
