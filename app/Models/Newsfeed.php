<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsfeed extends Model
{
    use HasFactory;

    protected $table="news_feeds";
    protected $fillable =[
        'title',
        'link',
        'description',
        'pubDate',
        'creator',
        'media'
    ];
}
