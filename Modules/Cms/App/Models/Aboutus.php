<?php

namespace Modules\Cms\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cms\Database\factories\AboutusFactory;

class Aboutus extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table="aboutus";
    protected $fillable = [
        'title1',
        'desc1',
        'image1',
        'cta_title',
        'cta_button_text',
        'cta_button_url',
        'cta_bg_image',
        'title2',
        'desc2',
        'image2'
    ];
    
    protected static function newFactory()
    {
        //return AboutusFactory::new();
    }
}
