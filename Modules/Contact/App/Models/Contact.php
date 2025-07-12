<?php

namespace Modules\Contact\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Contact\Database\factories\ContactFactory;

class Contact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = "contacts";
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message'
    ];

    protected static function newFactory()
    {
        //return ContactFactory::new();
    }
}
