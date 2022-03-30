<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Traits\HasAttachmentTrait;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;
    use HasAttachmentTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title','copyright','email','uuid'
    ];

        /*
    * get table of that model
    */
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
}
