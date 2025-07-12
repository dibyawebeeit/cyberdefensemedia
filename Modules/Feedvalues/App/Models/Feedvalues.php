<?php

namespace Modules\Feedvalues\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Feedvalues\Database\factories\FeedvaluesFactory;

class Feedvalues extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table="feed_values";
    protected $fillable = [
        'feed_id',
        'title',
        'link',
        'description',
        'pubDate',
        'creator',
        'media'
    ];
    
    protected static function newFactory()
    {
        //return FeedvaluesFactory::new();
    }
}
