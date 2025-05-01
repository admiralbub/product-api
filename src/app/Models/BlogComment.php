<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
class BlogComment extends Model
{
    use HasFactory,AsSource;

    protected $fillable = [
        'id',
        'comment',
        'user_name',
        'email',
        'phone',
        'post_id',
        'available'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];
    public function scopeAvailable($query)
    {
        return $query->where('available', 1);
    }
    public function posts()
    {
        return $this->belongsTo(Post::class,'post_id','id');
    }
}
