<?php

namespace Modules\Faq\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Faq\Database\factories\FaqFactory;

class Faq extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table="faqs";
    protected $fillable = [
        'question',
        'answer',
        'status'
    ];
    
    protected static function newFactory(): FaqFactory
    {
        //return FaqFactory::new();
    }
}
