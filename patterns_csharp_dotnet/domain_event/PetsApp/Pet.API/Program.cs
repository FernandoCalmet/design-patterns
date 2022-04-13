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

#region -> Fields

IMessageBroker _messageBroker = new MessageBroker();
IPetService petService = new PetService(_messageBroker);

#endregion -> Fields

#region -> Endpoints

app.MapPost("/pets", (PetViewModel pet) =>
{
    petService.Create(pet.Id, pet.Name, pet.DateOfBirth);

    return Results.Created($"/pets/{pet.Id}", pet);
})
.WithName("CreatePet");

app.MapPut("/pets/{id}", (PetViewModel pet) =>
{
    petService.Update(pet.Id, pet.Name, pet.DateOfBirth);

    return Results.Ok(pet);
})
.WithName("EditPet");

app.MapDelete("/pets/{id}", (Guid guid) =>
{
    petService?.Delete(guid);

    return Results.Ok();
})
.WithName("RemovePet");

app.MapGet("/pets", () =>
{
    return petService.GetAll();
})
.WithName("GetAllPets");

app.MapGet("/pets/{id}", (Guid uid) =>
{
    var petModel = petService.GetSingleById(uid);
    if (petModel != null)
        return Results.Ok(petModel);
    else
        return null;
})
.WithName("GetSinglePet");

#endregion -> Endpoints

app.Run();
