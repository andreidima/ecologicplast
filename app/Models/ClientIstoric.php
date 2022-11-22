<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientIstoric extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'clienti_istoric';
    protected $primaryKey = 'id_pk';
    protected $guarded = [];

    public function path()
    {
        return "/clienti-istoric/{$this->id}";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function user_istoric()
    {
        return $this->belongsTo(User::class, 'operatie_user_id');
    }
}
