<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoTechnicien extends Model
{
    use HasFactory;

	protected $fillable = ['title', 'url', 'duration', 'description', 'created_by'];
}
