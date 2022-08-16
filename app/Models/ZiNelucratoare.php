<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZiNelucratoare extends Model
{
    use HasFactory;

    protected $table = 'zile_nelucratoare';
    protected $guarded = [];

    public function path()
    {
        return "/zile-nelucratoare/{$this->id}";
    }
}
