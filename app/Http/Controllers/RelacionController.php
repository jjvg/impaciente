<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\User;
class RelacionController extends Controller
{
    public function check($id)
    {
    	if (Auth::user()->es_paciente_de($id)===1) 
    	{
    		return ["status" => "amigos"];
    	}

    	if (Auth::user()->Tiene_una_solicitud_de_relacion_pendiente_de($id))
    	{
    		return ["status" => "pendiente"];
    	}

    	if (Auth::user()->Tiene_una_solicitud_de_relacion_pendiente_enviada_a($id))
    	{
    		return ["status" => "esperando"];
    	}

    	return ["status"=>0];
    }
    public function agregar_relacion($id)
    {   
        // enviar email , notificaciones y demas 
       $resp = Auth::user()->agregar_relacion($id);

      // User::find($id)->notify(new \App\Notifications\NuevaSolicitudAmistad(Auth::user()) );

       return $resp;
    }
      public function aceptar_relacion($id)
    {   
        // enviar email , notificaciones y demas 
      $resp = Auth::user()->aceptar_relacion($id);

     // User::find($id)->notify(new \App\Notifications\SolicitudAmistadAceptada(Auth::user()) );

      return $resp;
    }
}
