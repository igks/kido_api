<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $table = "contents";

    protected $fillable = ['title_id', 'content', 'meaning','description', 'sequence'];

    public static function rules($merge = [])
    {
        return array_merge(
            [
                'title_id' => 'required',
                'content' => 'required',
                'meaning' => 'required',
                'sequence' => 'required'
            ],
            $merge
        );
    }
}