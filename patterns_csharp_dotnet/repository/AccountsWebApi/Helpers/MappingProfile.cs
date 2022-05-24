using AccountsWebApi.DataTransferObjects.Account;
using AccountsWebApi.DataTransferObjects.Owner;
using AccountsWebApi.Models;
using AutoMapper;

namespace AccountsWebApi.Helpers;

public class MappingProfile : Profile
{
    public MappingProfile()
    {
        CreateMap<Owner, GetOwnerDto>();
        CreateMap<Account, GetAccountDto>();
        CreateMap<OwnerForCreationDto, Owner>();
        CreateMap<OwnerForUpdateDto, Owner>();
    }
}