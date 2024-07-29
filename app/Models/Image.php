<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['image','service_id'];

    // public function getImageAttribute($value)
    // {
    //     return (!is_null($value)) ? env('APP_URL') . '/public/storage/' . $value : null;
    // }
}
