<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carte extends Model
{
    use HasFactory;

    protected $table = 'carti';
    protected $guarded = [];

    public function path()
    {
        return "/carti/{$this->id}";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
