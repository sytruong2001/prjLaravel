<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PostModel;
use App\Models\User;

class CommentModel extends Model
{
    use HasFactory;
    protected $table = 'comment';
    protected $primaryKey = 'id';
    protected $fillable = [
        'UserId',
        'PostId',
        'ParentId',
        'content',
        "created_at",
        "updated_at",

    ];

    public function post()
    {
        return $this->belongsTo(PostModel::class, 'PostId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UserId');
    }
}