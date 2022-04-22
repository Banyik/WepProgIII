<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = [
        'id',
        'user_id',
        'post_title',
        'post'
    ];
    public function post(){
        return $this->hasOne(User::class, 'id');
    }
}
