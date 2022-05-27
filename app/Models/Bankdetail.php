<?php

namespace App\Models;

use App\Support\UuidScopeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bankdetail extends Model
{
    use UuidScopeTrait, HasFactory;
    protected $fillable = [
        'user_id',
        'uuid',
        'bankname',
        'nameinaccount',
        'accountnumber',
        'branch',
        'ifsccode',
        'acctype'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
