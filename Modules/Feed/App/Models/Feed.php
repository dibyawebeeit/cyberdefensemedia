<?php

namespace Modules\Feed\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Feed\Database\factories\FeedFactory;

class Feed extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table="feeds";
    protected $fillable = [
        'name',
        'url',
        'status'
    ];
    
    protected static function newFactory()
    {
        //return FeedFactory::new();
    }
}
