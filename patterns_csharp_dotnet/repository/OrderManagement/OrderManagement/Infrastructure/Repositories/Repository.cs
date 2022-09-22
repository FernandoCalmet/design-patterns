using OrderManagement.Domain.Entities;
using OrderManagement.Domain.Repositories;
using System.Linq.Expressions;

namespace OrderManagement.Infrastructure.Repositories;

public abstract class Repository<T> : IRepository<T>
    where T : Entity
{
    protected OrderManagementContext _context;

    protected Repository(OrderManagementContext context)
    {
        _context = context;
    }

    public virtual T Add(T entity) =>
        _context.Add(entity).Entity;

    public virtual IEnumerable<T> GetAll() =>
        _context.Set<T>().ToList();

    public virtual IEnumerable<T> Get(Expression<Func<T, bool>> predicate) =>
        _context.Set<T>()
            .AsQueryable()
            .Where(predicate)
            .ToList();

    public virtual T GetById(int id)
    {
        var entity = _context.Find<T>(id);
        return entity ?? throw new ArgumentException($"Entity with {id} doesn't exists");
    }

    public virtual void Delete(T entity) =>
        _context.Remove(entity);
}