using Pets.Application.Contracts;
using Pets.Domain.AggregatesModel.PetAggregate;
using Pets.Domain.Events;

namespace Pets.Application.Models;

public class PetModel : IPetModel
{
    #region -> Attributes

    private Guid _id;
    private string _name;
    private DateTime _dateOfBirth;
    private ICollection<IDomainEvent> _domainEvents;
    private List<Pet> _petList;

    #endregion -> Attributes

    #region -> Constructors

    public PetModel()
    {
        _petList = new List<Pet>();
    }
    public PetModel(string name, DateTime dateOfBirth)
    {
        _name = name;
        _dateOfBirth = dateOfBirth;

        _petList = new List<Pet>();
    }
    public PetModel(Guid id, string name, DateTime dateOfBirth)
    {
        _id = id;
        _name = name;
        _dateOfBirth = dateOfBirth;

        _petList = new List<Pet>();
    }

    #endregion -> Constructors

    #region -> Properties

    public Guid Id
    {
        get { return _id; }
        set { _id = value; }
    }
    public string Name
    {
        get { return _name; }
        set { _name = value; }
    }
    public DateTime DateOfBirth
    {
        get { return _dateOfBirth; }
        set { _dateOfBirth = value; }
    }
    public ICollection<IDomainEvent> DomainEvents
    {
        get { return _domainEvents; }
        set { _domainEvents = value; }
    }

    #endregion -> Properties

    #region -> Public Methods

    public void Add(PetModel petModel)
    {
        var petEntity = MapPetEntity(petModel);
        _petList.Add(petEntity);
    }
    public Pet? Edit(PetModel petModel)
    {
        var petEntity = MapPetEntity(petModel);
        var petToUpdate = _petList.Find(p => p.Id == petEntity.Id);
        if (petToUpdate != null)
            return petToUpdate;
        else return null;
    }
    public void Remove(Guid uid)
    {
        var petEntity = _petList.Find(x => x.Id == uid);
        if (petEntity != null)
            _petList.Remove(petEntity);
    }
    public PetModel? GetSingle(Guid uid)
    {
        var petEntity = _petList.Find(x => x.Id == uid);
        if (petEntity != null)
            return MapPetModel(petEntity);
        else return null;
    }
    public IEnumerable<PetModel> GetAll()
    {
        return MapPetModel(_petList);
    }

    #endregion -> Public Methods

    #region -> Private Methods

    private PetModel MapPetModel(Pet petEntity)
    {
        var petModel = new PetModel
        {
            Id = petEntity.Id,
            Name = petEntity.Name.Value,
            DateOfBirth = petEntity.DateOfBirth.Value,
            DomainEvents = petEntity.DomainEvents
        };

        return petModel;
    }
    private List<PetModel> MapPetModel(IEnumerable<Pet> petEntityList)
    {
        var petModelList = new List<PetModel>();
        foreach (var petEntity in petEntityList)
        {
            petModelList.Add(MapPetModel(petEntity));
        };

        return petModelList;
    }
    private Pet MapPetEntity(PetModel petModel)
    {
        var newPetName = PetName.Create(petModel.Name);
        var newPetDateOfBirth = PetDateOfBirth.Create(petModel.DateOfBirth);
        var petEntity = new Pet(newPetName, newPetDateOfBirth);

        return petEntity;
    }
    private List<Pet> MapPetEntity(List<PetModel> petModelList)
    {
        var petEntityList = new List<Pet>();
        foreach (var petModel in petModelList)
        {
            petEntityList.Add(MapPetEntity(petModel));
        };

        return petEntityList;
    }

    #endregion -> Private Methods
}
