using Pet.Domain.AggregatesModel.PetAggregate.Entities;

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

var pets = new List<Pet.Domain.AggregatesModel.PetAggregate.Entities.Pet>();

app.MapGet("/pets", () =>
{
    return pets;
})
.WithName("GetAllPets");

app.MapGet("/pets/{id}", (Guid uid) =>
{
    return pets.Find(p => p.Id == uid) is Pet.Domain.AggregatesModel.PetAggregate.Entities.Pet pet ?
        Results.Ok(pet) :
        Results.NotFound("Sorry, pet not found.");
})
.WithName("GetPetById");

app.MapPost("/pets", (Pet.Domain.AggregatesModel.PetAggregate.Entities.Pet pet) =>
{
    var petCheckDuplicateId = pets.Find(p => p.Id == pet.Id);
    if (petCheckDuplicateId != null) return Results.NotFound("Sorry, pet ID is not available.");

    var petToCreate = new Pet.Domain.AggregatesModel.PetAggregate.Entities.Pet
    {
        Id = pet.Id
    };
    petToCreate.SetName(pet.Name);
    petToCreate.SetDateOfBirth(pet.DateOfBirth);

    pets.Add(petToCreate);

    return Results.Created($"/pets/{petToCreate.Id}", petToCreate);
})
.WithName("CreatePet");

app.MapPut("/pets/{id}", (Guid uid, Pet.Domain.AggregatesModel.PetAggregate.Entities.Pet pet) =>
{
    var petToUpdate = pets.Find(p => p.Id == uid);
    if (petToUpdate == null) return Results.NotFound("Sorry, pet not found.");

    petToUpdate.SetName(pet.Name);
    petToUpdate.SetDateOfBirth(pet.DateOfBirth);

    return Results.Ok(petToUpdate);
})
.WithName("EditPet");

app.MapDelete("/pets/{id}", (Guid uid) =>
{
    var petToDelete = pets.Find(p => p.Id == uid);
    if (petToDelete == null) return Results.NotFound("Sorry, pet not found.");

    pets.Remove(petToDelete);

    return Results.Ok(pets);
})
.WithName("RemovePet");

app.Run();
