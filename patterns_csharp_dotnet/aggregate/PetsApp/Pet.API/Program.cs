using Pets.Domain.AggregatesModel.PetAggregate;

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

var pets = new List<Pet>();

app.MapGet("/pets", () =>
{
    return pets;
})
.WithName("GetAllPets");

app.MapGet("/pets/{id}", (Guid uid) =>
{
    return pets.Find(p => p.Id == uid) is Pet pet ?
        Results.Ok(pet) :
        Results.NotFound("Sorry, pet not found.");
})
.WithName("GetSinglePetById");

app.MapPost("/pets", (string name, DateTime date) =>
{
    var newPetGuid = Guid.NewGuid();
    var newPetName = PetName.Create(name);
    var newPetDateOfBirth = PetDateOfBirth.Create(date);
    var petToCreate = new Pet(newPetGuid, newPetName, newPetDateOfBirth);
    pets.Add(petToCreate);

    return Results.Created($"/pets/{petToCreate.Id}", petToCreate);
})
.WithName("CreatePet");

app.MapPut("/pets/{id}", (Guid uid, string name, DateTime date) =>
{
    var petToUpdate = pets.Find(p => p.Id == uid);
    if (petToUpdate == null) return Results.NotFound("Sorry, pet not found.");
    var newPetName = PetName.Create(name);
    var newPetDateOfBirth = PetDateOfBirth.Create(date);
    petToUpdate.SetName(newPetName);
    petToUpdate.SetDateOfBirth(newPetDateOfBirth);

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
