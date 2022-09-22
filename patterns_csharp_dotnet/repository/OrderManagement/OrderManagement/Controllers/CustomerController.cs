using Microsoft.AspNetCore.Mvc;
using OrderManagement.Domain.Repositories;

namespace OrderManagement.Controllers;

[Route("api/[controller]")]
[ApiController]
public class CustomerController : ControllerBase
{
    private readonly ICustomerRepository _customerRepository;

    public CustomerController(ICustomerRepository customerRepository)
    {
        _customerRepository = customerRepository;
    }

    [HttpGet]
    public ActionResult GetAll()
    {
        var customers = _customerRepository.GetAll();

        return Ok(customers);
    }
}