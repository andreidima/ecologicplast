<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clienti';
    protected $guarded = [];

    public function path()
    {
        return "/clienti/{$this->id}";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
