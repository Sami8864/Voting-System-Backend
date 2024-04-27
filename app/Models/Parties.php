<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// This PHP class, within a Laravel application, represents a model for the "Parties" table in the database. It extends Laravel's Eloquent Model class and uses the HasFactory trait for factory support. The `$fillable` property specifies which attributes can be mass-assigned, allowing these attributes to be set directly on the model using methods like `create()` or `update()`. In this case, the "name", "image", and "leader" attributes are fillable.

class Parties extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image', 'leader'];
}
