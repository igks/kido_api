<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReqLogs extends Model
{
  use HasFactory;

  protected $table = "request_logs";
  public $timestamps = false;

  protected $fillable = ['date', 'counter', 'title_id'];

  public function title()
  {
    return $this->belongsTo(Title::class);
  }
}
