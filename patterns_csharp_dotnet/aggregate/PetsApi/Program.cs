using System.Collections.Generic;
using PetsApi.Domain.Entities;
using PetsApi.Domain.ValueObjects;

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

List<Pet> pets = new List<Pet>();

app.MapGet("/pets", () =>
{
    return pets;
})
.WithName("GetAllPets");

app.MapGet("/pets/{id}", (Guid id) =>
{
    return pets.Find(p => p.Id == id);
})
.WithName("GetPetById");

app.MapPost("/pets", (Pet pet) =>
{
    pets.Add(pet);
    return pet;
})
.WithName("CreatePet");

app.MapPut("/pets/{id}", (Guid id, Pet pet) =>
{
    var petToUpdate = pets.Find(p => p.Id == id);
    petToUpdate.SetPetName(pet.Name);
    petToUpdate.SetPetDateOfBirth(pet.DateOfBirth);
    return petToUpdate;
})
.WithName("EditPet");

app.MapDelete("/pets/{id}", (Guid id) =>
{
    var petToDelete = pets.Find(p => p.Id == id);
    pets.Remove(petToDelete);
    return petToDelete;
})
.WithName("RemovePet");

app.Run();
