<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $fillable = ['name', 'description'];

    public static function rules($merge = [])
    {
        return array_merge(
            [
                'name' => 'required'
            ],
            $merge
        );
    }

    public function title(){
        return $this->hasMany(Title::class);
    }
}