<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'imagePath',
        'body',

    ];
    //we have a post and it belongs to a user
    public function user(){
        return $this->belongsTo(User::class);
    }
// we have a post and it belongsTo a category

    public function category(){
     return $this->belongsTo(category::class);
    } 
}
