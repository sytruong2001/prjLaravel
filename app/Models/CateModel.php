<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CateModel extends Model
{
    use HasFactory;

    protected $table = 'cate';

    protected $fillable = [
        'nameCate',

    ];

    public function getInfo()
    {
        $infoCate = CateModel::all();
        return [
            'infoCate' => $infoCate,
        ];
    }
}