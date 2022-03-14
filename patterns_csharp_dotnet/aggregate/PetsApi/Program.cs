using PetsApi.Domain.Entities;

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

List<Pet> pets = new();

app.MapGet("/pets", () =>
 {
     return pets;
 })
.WithName("GetAllPets");

app.MapGet("/pets/{id}", (Guid id) =>
{
    return pets.Find(p => p.Id == id) is Pet pet ?
        Results.Ok(pet) :
        Results.NotFound("Sorry, pet not found.");
})
.WithName("GetPetById");

app.MapPost("/pets", (Pet pet) =>
{
    pets.Add(pet);
    return Results.Ok(pet);
})
.WithName("CreatePet");

app.MapPut("/pets/{id}", (Guid id, Pet pet) =>
{
    var petToUpdate = pets.Find(p => p.Id == id);
    if (petToUpdate == null) return Results.NotFound("Sorry, pet not found.");

    petToUpdate.SetPetName(pet.Name);
    petToUpdate.SetPetDateOfBirth(pet.DateOfBirth);

    return Results.Ok(petToUpdate);
})
.WithName("EditPet");

app.MapDelete("/pets/{id}", (Guid id) =>
{
    var petToDelete = pets.Find(p => p.Id == id);
    if (petToDelete == null) return Results.NotFound("Sorry, pet not found.");

    pets.Remove(petToDelete);
    return Results.Ok(petToDelete);
})
.WithName("RemovePet");

app.Run();
