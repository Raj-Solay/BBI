<?php

namespace App\Models;

use App\Support\HasRolesUuid;
use App\Support\HasSocialLogin;
use App\Support\UuidScopeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User.
 */
class User extends Authenticatable
{
    use Notifiable, UuidScopeTrait, HasFactory, HasApiTokens, HasRoles, SoftDeletes, HasSocialLogin, HasRolesUuid {
        HasRolesUuid::getStoredRole insteadof HasRoles;
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'uuid',
        'email',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function socialProviders()
    {
        return $this->hasMany(SocialProvider::class);
    }

    public static function create(array $attributes = [])
    {
        if (array_key_exists('password', $attributes)) {
            $attributes['password'] = Hash::make($attributes['password']);
        }

        $model = static::query()->create($attributes);

        return $model;
    }

    public function Personal()
    {
        return $this->hasMany(Personal::class);
    }
    public function bankDetails()
    {
        return $this->hasMany(bankDetail::class);
    }
    public function childrenDetails()
    {
        return $this->hasMany(Childrendetail::class);
    }
    public function eductionalDetails()
    {
        return $this->hasMany(Educationaldetail::class);
    }
    public function familyDetail()
    {
        return $this->hasMany(FamilyDetail::class);
    }
    public function healthdetail()
    {
        return $this->hasMany(Healthdetail::class);
    }

    public function relation()
    {
        return $this->hasMany(UserReferences::class);
    }

    public function interests()
    {
        return $this->hasMany(UserExpressionInterest::class);
    }

    public function checklist()
    {
        return $this->hasMany(UserChecklist::class);
    }

    public function social()
    {
        return $this->hasMany(UserSocialIdentityDetail::class);
    }

    public function authorization()
    {
        return $this->hasMany(Authorization::class);
    }
    public function document()
    {
        return $this->hasMany(UserDocument::class);
    }

    public function PersonalReference(){
        return $this->hasMany(PersonalReference::class);

    }

    public function Staff(){
        return $this->hasMany(StaffDetail::class);
    }
    public function Location(){
        return $this->hasMany(Location::class);
    }

    public function finability(){
        return $this->hasMany(UserFinability::class);
    }
    public function agreements(){
        return $this->hasMany(Agreement::class);
    }
}
