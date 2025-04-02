<?php

namespace App\Enums;

// Creation of a class to enhance the Status field of our Profile table with limited data.
enum ProfileStatus: string
{
    case Active = 'active';
    case Inactive = 'inactive';
    case Pending = 'pending';
}
