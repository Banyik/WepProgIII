<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostFile extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = [
        'id',
        'post_id',
        'file'
    ];
}
