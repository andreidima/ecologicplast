<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ClientIstoric;

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

    public function istoricuri()
    {
        return $this->hasMany(ClientIstoric::class, 'id');
    }
}
