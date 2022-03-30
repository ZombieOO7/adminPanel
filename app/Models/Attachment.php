<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $table = 'attachments';

    protected $primaryKey = 'id';

    protected $fillable =[
        'url',
        'attachmentable_id',
        'attachmentable_type',
    ];

    protected $appends = ['image_path'];

    public function getImagePathAttribute(): string
    {
        if($this->url != null && file_exists(storage_path('app/'.$this->url))){
            return url('storage/app/'.$this->url);
        }else{
            return $this->_defaultImagePath();
        }
    }

    private function _defaultImagePath(): string
    {
        return asset('backend/images/blank.png');
    }

        /**
     * Get the owning attachmentable model.
     */
    public function attachmentable()
    {
        return $this->morphTo();
    }

    public function getImagePath2Attribute()
    {
        if($this->url != null && file_exists(storage_path('app/'.$this->url))){
            return url('storage/app/'.$this->url);
        }
        return null;
    }

    public function getLogoPathAttribute(): string
    {
        if($this->url != null && file_exists(storage_path('app/'.$this->url))){
            return url('storage/app/'.$this->url);
        }else{
            return $this->_defaultLogoPath();
        }
    }
    private function _defaultLogoPath(): string
    {
        return asset('backend/media/logos/logo-1.svg');
    }
}
