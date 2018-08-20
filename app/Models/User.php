<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticable;

/**
 * Class User
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int $document_number
 */
class User extends Authenticable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'document_number',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * @return HasMany
     */
    public function addresses() : HasMany
    {
        return $this->hasMany(UserAddress::class,'user_id');
    }

    /**
     * @return HasMany
     */
    public function orders() : HasMany
    {
        return $this->hasMany(Order::class,'user_id');
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $user =  collect(parent::toArray())->all();
        return $user;
    }
}
