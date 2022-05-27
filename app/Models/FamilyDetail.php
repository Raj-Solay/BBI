<?php

namespace App\Models;

use App\Support\UuidScopeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyDetail extends Model
{
    use UuidScopeTrait, HasFactory;
    protected $fillable = [
        'user_id',
        'uuid',
        'name',
        'age',
        'relation',
        'education',
        'occupation',
        'monthlyincome',
        'contactno',
        'address'
    ];
}
