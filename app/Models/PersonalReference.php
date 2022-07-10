<?php

namespace App\Models;

use App\Support\UuidScopeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalReference extends Model
{
    use UuidScopeTrait, HasFactory;
    protected $fillable = [
        'id',
        'uuid',
        'birthidentificationmarks',
        'handuse',
        'weight'

    ];
}
