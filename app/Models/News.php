<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable =[
            'title',
            'author',
            'content',
            'published'
    ];



















    protected $attributes = [
        'published' => false,
    ];




    




    protected $casts = [
        'published' => 'boolean',
    ];

    


    public function isPublished():bool{
        return $this->published === true;
    }

}
