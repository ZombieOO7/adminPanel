<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BaseModel extends Model
{
    use HasFactory;
    use SoftDeletes {
        SoftDeletes::restore as sfRestore;
    }

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

    /**
     * This function is used for getting active records of table
     *
     * @return void
     */
    public function scopeActive($query)
    {
        return $query->where('status', '1');
    }

    /**
     * This function is used for getting created date in d/m/y
     *
     * @return void
     */
    public function getProperCreatedAtAttribute()
    {
        $value = $this->attributes['created_at'];
        return '<span class="d-none">' . date('Ymd', strtotime($value)) . '</span>' . date('d-m-Y', strtotime($value));
    }

    /**
     * Set Active/Inactive tag in List
     *
     * @return void
     */
    public function getProperStatusAttribute()
    {
        if($this->status == '0'){
            return '<span class="m-badge  m-badge--danger m-badge--wide">'.__('label.inactive').'</span>';
        }
        else{
            return '<span class="m-badge  m-badge--success m-badge--wide">'.__('label.active').'</span>';
        }
    }
}
