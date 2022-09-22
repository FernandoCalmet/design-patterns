using Microsoft.AspNetCore.Mvc;
using OrderManagement.Domain.Entities;
using OrderManagement.Domain.Repositories;

namespace OrderManagement.Controllers;

[Route("api/[controller]")]
[ApiController]
public class OrderController : ControllerBase
{
    private readonly IOrderRepository _orderRepository;
    private readonly IUnitOfWork _unitOfWork;
    private readonly ILogger _logger;

    public OrderController(
        IOrderRepository orderRepository,
        IUnitOfWork unitOfWork,
        ILogger logger)
    {
        _orderRepository = orderRepository;
        _unitOfWork = unitOfWork;
        _logger = logger;
    }

    [HttpPost]
    public IActionResult Create(
        string description,
        string deliveryAddress,
        decimal price)
    {
        var order = new Order(description, deliveryAddress, price);

        _orderRepository.Add(order);

        _unitOfWork.Commit();

        return Ok();
    }

    [HttpGet]
    public IActionResult GetAll() =>
        Ok(_orderRepository.GetAll());

    [HttpGet("mostExpensive")]
    public IActionResult GetTheMostExpensive() =>
        Ok(_orderRepository.GetTheMostExpensive());
}
