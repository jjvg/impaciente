<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $fillable = ['direccion','informacion','user_id'];

   public function user()
   {
   	 return $this -> belongsTo('App\User');
   }
}
