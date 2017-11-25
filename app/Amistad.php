<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amistad extends Model
{
    protected $fillable = ['solicitud', 'user_solicitante', 'status'];
}
