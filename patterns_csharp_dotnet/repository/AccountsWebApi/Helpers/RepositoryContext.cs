using AccountsWebApi.Models;
using Microsoft.EntityFrameworkCore;

namespace AccountsWebApi.Helpers;

public class RepositoryContext : DbContext
{
    public RepositoryContext(DbContextOptions options)
        : base(options)
    {
    }
    public DbSet<Owner>? Owners { get; set; }
    public DbSet<Account>? Accounts { get; set; }
}