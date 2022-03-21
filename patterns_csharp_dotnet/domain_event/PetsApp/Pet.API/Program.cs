using Pets.API.ViewModel;
using Pets.Application.Contracts;
using Pets.Application.Services;

var builder = WebApplication.CreateBuilder(args);

// Add services to the container.
// Learn more about configuring Swagger/OpenAPI at https://aka.ms/aspnetcore/swashbuckle
builder.Services.AddEndpointsApiExplorer();
builder.Services.AddSwaggerGen();

var app = builder.Build();

// Configure the HTTP request pipeline.
if (app.Environment.IsDevelopment())
{
    app.UseSwagger();
    app.UseSwaggerUI();
}

app.UseHttpsRedirection();

IMessageBroker _messageBroker = new MessageBrokerService();
var petService = new PetService(_messageBroker);
var petViewModel = new PetViewModel();
List<PetViewModel> petViewList = new();

app.MapGet("/pets", () =>
{
    petViewList = petViewModel.MapPetViewModel(petService.GetAll());
    return petViewList;
})
.WithName("GetAllPets");

app.MapGet("/pets/{id}", (Guid uid) =>
{
    var petModel = petService.GetSingleById(uid);
    if (petModel != null)
        return Results.Ok(petViewModel.MapPetViewModel(petModel));
    else
        return null;
})
.WithName("GetSinglePetById");

app.MapPost("/pets", (PetViewModel pet) =>
{
    var petModel = petViewModel.MapPetModel(pet);
    petService.Create(petModel.Name, petModel.DateOfBirth);
    return Results.Created($"/pets/{pet.Id}", pet);
})
.WithName("CreatePet");

app.MapPut("/pets/{id}", (Guid uid, PetViewModel pet) =>
{
    var petModel = petViewModel.MapPetModel(pet);
    petService.Update(uid, petModel.Name, petModel.DateOfBirth);

    return Results.Ok(pet);
})
.WithName("EditPet");

app.MapDelete("/pets/{id}", (Guid uid) =>
{
    petService?.Delete(uid);
    return Results.Ok();
})
.WithName("RemovePet");

app.Run();
