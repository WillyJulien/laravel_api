<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Administrator extends Model
{
    // Uses HasFactory to enable template creation via factories ( for testing and seeding ).
    // Use HasApiTokens to manage API authentication via tokens with Laravel Sanctum.
    // Use Notifiable to send notifications to the administrator via various channels( example reset password ).

    use HasFactory;
    use HasApiTokens;
    use Notifiable;
    // The $fillable property specifies which attributes can be mass-assigned during a request.
    // In this case, 'name', 'email', and 'password' can be mass-assigned.
    protected $fillable = [ 'name', 'email', 'password' ];
    // The $hidden property specifies which attributes should be hidden when the model is converted to an array or JSON.
    // Here, 'password' will be hidden in array or JSON representations of the model, even if it's included in the request.
    protected $hidden = [ 'password' ];

}
