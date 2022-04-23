<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'id',
        'post_id',
        'user_id',
        'comment_post',
        'created_at'
    ];
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
