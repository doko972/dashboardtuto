<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected $fillable = [
        'title',
        'url',
        'duration',
        'description',
        'role',
        'created_by'
    ];
}
