<?php

namespace Modules\Cms\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cms\Database\factories\SectionFactory;

class Section extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table="cms_section";
    protected $fillable = [
        'section_title'
    ];
    
    protected static function newFactory()
    {
        //return SectionFactory::new();
    }
}
