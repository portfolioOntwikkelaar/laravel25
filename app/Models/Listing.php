<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // ✅ toevoegen
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory; // ✅ trait gebruiken

    // andere modelcode
}
