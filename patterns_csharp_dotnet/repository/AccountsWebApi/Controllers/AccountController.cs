using AccountsWebApi.Contracts;
using AccountsWebApi.Models;
using Microsoft.AspNetCore.Mvc;

namespace AccountsWebApi.Controllers;

[Route("api/[controller]")]
[ApiController]
public class AccountController : ControllerBase
{
    private readonly IRepositoryWrapper _repository;

    public AccountController(IRepositoryWrapper repository)
    {
        _repository = repository;
    }

    [HttpGet]
    public async Task<IActionResult> GetAllAccounts()
    {
        var accounts = await _repository.Account.GetAllAccounts();
        return Ok(accounts);
    }

    [HttpGet("{id}", Name = "AccountById")]
    public async Task<IActionResult> GetAccountById(Guid id)
    {
        var account = await _repository.Account.AccountsByOwner(id);
        if (account == null)
        {
            return NotFound();
        }
        return Ok(account);
    }
}
