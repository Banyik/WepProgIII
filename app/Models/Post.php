<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'id',
        'user_id',
        'post_title',
        'post',
        'created_at'
    ];
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
