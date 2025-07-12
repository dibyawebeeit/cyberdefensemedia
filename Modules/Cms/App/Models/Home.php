<?php

namespace Modules\Cms\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cms\Database\factories\HomeFactory;
use Modules\Feedvalues\App\Models\Feedvalues;

class Home extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table="cms_home";
    protected $fillable = [
        'section_id',
        'block_id',
        'feed_id',
        'items',
        'title_length',
        'desc_length'
    ];

    public function sectionDetails()
    {
        return $this->belongsTo(Section::class,'section_id','id')->select('id','section_title');
    }

    // public function feedList()
    // {
    //     return $this->hasMany(Feedvalues::class,'feed_id','feed_id');
    // }

    public function feedList()
    {
        return $this->hasMany(Feedvalues::class, 'feed_id', 'feed_id')
                    ->orderByRaw("STR_TO_DATE(pubDate, '%d %b %Y') DESC");
    }
    
    protected static function newFactory()
    {
        //return HomeFactory::new();
    }
}
