﻿using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace AccountsWebApi.Models;

[Table("Account")]
public class Account
{
    [Column("AccountId")]
    public Guid Id { get; set; }
    
    [Required(ErrorMessage = "Date created is required")]    
    public DateTime DateCreated { get; set; }
    
    [Required(ErrorMessage = "Account type is required")]    
    public string AccountType { get; set; }
    [Required(ErrorMessage = "Owner Id is required")]    
    
    [ForeignKey(nameof(Owner))]
    public Guid OwnerId { get; set; }
    public Owner Owner { get; set; }
}