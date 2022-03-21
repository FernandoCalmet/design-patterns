using Pets.Application.Models;

namespace Pets.API.ViewModel;

public class PetViewModel
{
    #region -> Fields

    private Guid _id;
    private string _name;
    private DateTime _dateOfBirth;

    #endregion -> Fields

    #region -> Constructors

    public PetViewModel() { }

    public PetViewModel(Guid id, string name, DateTime dateOfBirth)
    {
        _id = id;
        _name = name;
        _dateOfBirth = dateOfBirth;
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

    #endregion -> Properties

    #region -> Public Methods

    public PetViewModel MapPetViewModel(PetModel petModel)
    {
        var petViewModel = new PetViewModel
        {
            Id = petModel.Id,
            Name = petModel.Name,
            DateOfBirth = petModel.DateOfBirth
        };
        return petViewModel;
    }

    public List<PetViewModel> MapPetViewModel(IEnumerable<PetModel> petModelList)
    {
        var petViewModelList = new List<PetViewModel>();

        foreach (var petModel in petModelList)
        {
            petViewModelList.Add(MapPetViewModel(petModel));
        }
        return petViewModelList;
    }

    public PetModel MapPetModel(PetViewModel petViewModel)
    {
        var petModel = new PetModel
        {
            Id = _id,
            Name = _name,
            DateOfBirth = _dateOfBirth,
        };
        return petModel;
    }
    public List<PetModel> MapPetModel(List<PetViewModel> petViewModelList)
    {
        var petModelList = new List<PetModel>();

        foreach (var petViewModel in petViewModelList)
        {
            petModelList.Add(MapPetModel(petViewModel));
        }
        return petModelList;
    }

    #endregion -> Public Methods
}
