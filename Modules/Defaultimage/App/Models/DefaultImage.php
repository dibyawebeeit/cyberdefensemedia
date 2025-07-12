<?php

namespace Modules\Defaultimage\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Defaultimage\Database\factories\DefaultImageFactory;

class DefaultImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table ="default_images";
    protected $fillable = [
        'file',
        'type'
    ];
    
    protected static function newFactory()
    {
        //return DefaultImageFactory::new();
    }
}
