<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable=['name','user_id','file','text'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
