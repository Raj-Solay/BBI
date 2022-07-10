<?php

namespace App\Models;

use App\Support\UuidScopeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileLink extends Model
{
    use UuidScopeTrait, HasFactory;
    protected $fillable = [
        'id',
        'link_name',
        'category',
        'link_icon',
        'desp_order'
    ];
}
