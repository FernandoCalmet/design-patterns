using OrderManagement.Domain.Entities;
using System.Linq.Expressions;

namespace OrderManagement.Domain.Repositories;

public interface IRepository<T>
    where T : Entity
{
    T Add(T entity);
    IEnumerable<T> GetAll();
    IEnumerable<T> Get(Expression<Func<T, bool>> predicate);
    T GetById(int id);
    void Delete(T entity);
}