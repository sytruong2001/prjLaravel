<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CommentModel;
use App\Models\User;

class PostModel extends Model
{
    use HasFactory;
    protected $table = 'post';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'slug',
        'content',
        'description',
        "created_at",
        "updated_at",

    ];

    public function comment()
    {
        return $this->hasMany(CommentModel::class, 'PostId')->whereNull('ParentId');
    }

    public function rep()
    {
        return $this->hasMany(CommentModel::class, 'PostId')->whereNotNull('ParentId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author');
    }
}