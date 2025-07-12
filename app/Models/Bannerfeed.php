<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bannerfeed extends Model
{
    use HasFactory;

    protected $table="bannerfeeds";
    protected $fillable =[
        'title',
        'link',
        'description',
        'pubDate',
        'creator',
        'media'
    ];
}
