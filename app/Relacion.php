<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relacion extends Model
{
    protected $fillable = ['solicitud', 'user_solicitante', 'status'];
}
