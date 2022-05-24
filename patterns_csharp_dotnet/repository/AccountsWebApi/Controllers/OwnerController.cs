using AccountsWebApi.Contracts;
using AccountsWebApi.DataTransferObjects.Owner;
using AccountsWebApi.Models;
using AutoMapper;
using Microsoft.AspNetCore.Mvc;

namespace AccountsWebApi.Controllers;

[Route("api/[controller]")]
[ApiController]
public class OwnerController : ControllerBase
{
    private readonly ILogger<OwnerController> _logger;
    private readonly IRepositoryWrapper _repository;
    private readonly IMapper _mapper;

    public OwnerController(IRepositoryWrapper repository, ILogger<OwnerController> logger, IMapper mapper)
    {
        _repository = repository;
        _logger = logger;
        _mapper = mapper;
    }

    [HttpGet]
    public async Task<IActionResult> GetAllOwners()
    {
        try
        {
            var owners = await _repository.Owner.GetAllOwners();
            _logger.LogInformation($"Returned all owners from database.");

            var ownersResult = _mapper.Map<IEnumerable<GetOwnerDto>>(owners);
            return Ok(ownersResult);
        }
        catch (Exception ex)
        {
            _logger.LogError($"Something went wrong inside GetAllOwners action: {ex.Message}");
            return StatusCode(500, "Internal server error");
        }
    }

    [HttpGet("{id}", Name = "OwnerById")]
    public async Task<IActionResult> GetOwnerById(Guid id)
    {
        try
        {
            var owner = await _repository.Owner.GetOwnerById(id);

            if (owner is null)
            {
                _logger.LogError($"Owner with id: {id}, hasn't been found in db.");
                return NotFound();
            }
            else
            {
                _logger.LogInformation($"Returned owner with id: {id}");

                var ownerResult = _mapper.Map<GetOwnerDto>(owner);
                return Ok(ownerResult);
            }
        }
        catch (Exception ex)
        {
            _logger.LogError($"Something went wrong inside GetOwnerById action: {ex.Message}");
            return StatusCode(500, "Internal server error");
        }
    }

    [HttpGet("{id}/account")]
    public async Task<IActionResult> GetOwnerWithDetails(Guid id)
    {
        try
        {
            var owner = await _repository.Owner.GetOwnerWithDetails(id);

            if (owner == null)
            {
                _logger.LogError($"Owner with id: {id}, hasn't been found in db.");
                return NotFound();
            }
            else
            {
                _logger.LogInformation($"Returned owner with details for id: {id}");

                var ownerResult = _mapper.Map<GetOwnerDto>(owner);
                return Ok(ownerResult);
            }
        }
        catch (Exception ex)
        {
            _logger.LogError($"Something went wrong inside GetOwnerWithDetails action: {ex.Message}");
            return StatusCode(500, "Internal server error");
        }
    }

    [HttpPost]
    public async Task<IActionResult> CreateOwner([FromBody] OwnerForCreationDto owner)
    {
        try
        {
            if (owner is null)
            {
                _logger.LogError("Owner object sent from client is null.");
                return BadRequest("Owner object is null");
            }

            if (!ModelState.IsValid)
            {
                _logger.LogError("Invalid owner object sent from client.");
                return BadRequest("Invalid model object");
            }

            var ownerEntity = _mapper.Map<Owner>(owner);

            _repository.Owner.CreateOwner(ownerEntity);
            await _repository.SaveAsync();

            var createdOwner = _mapper.Map<GetOwnerDto>(ownerEntity);
            _logger.LogInformation($"Created owner with id: {createdOwner.Id}");
            return CreatedAtRoute("OwnerById", new { id = createdOwner.Id }, createdOwner);
        }
        catch (Exception ex)
        {
            _logger.LogError($"Something went wrong inside CreateOwner action: {ex.Message}");
            return StatusCode(500, "Internal server error");
        }
    }

    [HttpPut("{id}")]
    public async Task<IActionResult> UpdateOwner(Guid id, [FromBody] OwnerForUpdateDto owner)
    {
        try
        {
            if (owner is null)
            {
                _logger.LogError("Owner object sent from client is null.");
                return BadRequest("Owner object is null");
            }

            if (!ModelState.IsValid)
            {
                _logger.LogError("Invalid owner object sent from client.");
                return BadRequest("Invalid model object");
            }

            var ownerEntity = await _repository.Owner.GetOwnerById(id);
            if (ownerEntity is null)
            {
                _logger.LogError($"Owner with id: {id}, hasn't been found in db.");
                return NotFound();
            }

            _mapper.Map(owner, ownerEntity);

            _repository.Owner.UpdateOwner(ownerEntity);
            await _repository.SaveAsync();

            _logger.LogInformation($"Updated owner with id: {ownerEntity.Id}");
            return NoContent();
        }
        catch (Exception ex)
        {
            _logger.LogError($"Something went wrong inside UpdateOwner action: {ex.Message}");
            return StatusCode(500, "Internal server error");
        }
    }

    [HttpDelete("{id}")]
    public async Task<IActionResult> DeleteOwner(Guid id)
    {
        try
        {
            var owner = await _repository.Owner.GetOwnerById(id);
            if (owner == null)
            {
                _logger.LogError($"Owner with id: {id}, hasn't been found in db.");
                return NotFound();
            }

            if (_repository.Account.AccountsByOwner(id).Result.Any())
            {
                _logger.LogError($"Cannot delete owner with id: {id}. It has related accounts. Delete those accounts first");
                return BadRequest("Cannot delete owner. It has related accounts. Delete those accounts first");
            }

            _repository.Owner.DeleteOwner(owner);
            await _repository.SaveAsync();

            _logger.LogInformation($"Deleted owner with id: {owner.Id}");
            return NoContent();
        }
        catch (Exception ex)
        {
            _logger.LogError($"Something went wrong inside DeleteOwner action: {ex.Message}");
            return StatusCode(500, "Internal server error");
        }
    }
}
