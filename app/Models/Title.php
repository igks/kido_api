<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    use HasFactory;

    protected $table = "titles";

    protected $fillable = ['category_id', 'title'];

    public static function rules($merge = [])
    {
        return array_merge(
            [
                'category_id' => 'required',
                'title' => 'required',
            ],
            $merge
        );
    }

    public function content()
    {
        return $this->hasMany(Content::class);
    }

    public function reqLog()
    {
        return $this->hasMany(ReqLogs::class);
    }

    public static function getName($id)
    {
        return Title::find($id)->title;
    }
}
