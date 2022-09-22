namespace OrderManagement.Domain.Repositories;

public interface IUnitOfWork
{
    void Commit();
}