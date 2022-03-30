<?php

namespace App\Models;

use App\Traits\HasAttachmentTrait;
use Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    use HasRoles;
    use SoftDeletes;
    use HasAttachmentTrait;
    protected $guard = 'admin';

    protected $fillable = [
        'uuid','name','email','email_verified_at','password','status','remember_token'
    ];

    public function getTableName()
    {
        return $this->getTable();
    }

    /*
    * Auto-sets values on creation
    */
    protected static function boot()
    {
        parent::boot();
        self::creating(function ($query) {
            if (Schema::hasColumn($query->getTableName(), 'uuid')) {
                $query->uuid = (string) Str::uuid();
            }
        });
    }

    /*
    * set Hash password attribute
    */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
}
