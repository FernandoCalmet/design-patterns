using PetsApp.Domain.Entities;
using PetsApp.Domain.ValueObjects;

PetName catName = PetName.Create("Kitty");
PetDateOfBirth catDateOfBirth = PetDateOfBirth.Create(new DateOnly(2020, 1, 1));
Pet cat = new Pet(catName, catDateOfBirth);

PetName dogName = PetName.Create("Doggy");
PetDateOfBirth dogDateOfBirth = PetDateOfBirth.Create(new DateOnly(2021, 2, 3));
Pet dog = new Pet(dogName, dogDateOfBirth);

Console.WriteLine(cat.ToString());
Console.WriteLine(dog.ToString());

Console.ReadKey();