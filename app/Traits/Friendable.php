<?php

namespace App\Traits;
use App\Relacion;
trait Friendable
{
	// METODO PARA SOLICITAR AGREGAR UN NUEVO AMIGO
	public function agregar_relacion($user_solicitante_id)
	{

		if ($this->id === $user_solicitante_id) {
			return 0;
		}

		if ($this->Tiene_una_solicitud_de_relacion_pendiente_enviada_a($user_solicitante_id)===1) {
			return "Ya existe una solicitud enviada a ese usuario";
		}

		if ($this->Tiene_una_solicitud_de_relacion_pendiente_de($user_solicitante_id)===1) {
			return $this->aceptar_amigo($user_solicitante_id);
		}

		if ($this->es_paciente_de($user_solicitante_id)===1) {
			return "Ya tienen una relacion paciente doctor";
			
		}

		$relacion = Relacion::create([

			'solicitud' => $this->id,
			'user_solicitante'=> $user_solicitante_id
		]);

		if ($relacion)
		 {

			return 1;
		}

			return 0;
	}


// METODO PARA ACEPTAR UN AMIGO NUEVO
	public function aceptar_relacion($solicitud)
	{
		if ($this->Tiene_una_solicitud_de_relacion_pendiente_de($solicitud)===0) {
			return 0;
		}

		$relacion = Relacion::where('solicitud', $solicitud)
							->where('user_solicitante', $this->id)
							->first();

		if ($relacion) 
		{
			
			$relacion->update([

				'status' => 1

			]);

			return 1;
		}

			return 0;

	}


// METODOOOO LISTA DE AMiGOS
	public function amigos()
	{
		$relacion =  array( );

		$f1 = Relacion::where('status',1)->where('solicitud', $this->id)->get();

		foreach ($f1 as $relacion): 
			
			array_push($relacion,\App\User::find($relacion->user_solicitante) );
		endforeach;
		
		$relacion2 =  array( );

		$f2 = Relacion::where('status',1)->where('user_solicitante', $this->id)->get();

		foreach ($f2 as $relacion2): 
			
			array_push($relacion2,\App\User::find($relacion->solicitud) );
		endforeach;


		return array_merge($relacion,$relacion2);
		
	}

	//METODO QUE RETORNA ARREGLO CCON EL ID DE LAS AMIGOS DEL USUSARIO 
	public function amigos_ids()
	{
		return  collect($this->amigos())->pluck('id')->toArray();
	}


//METODO PARA RETORNAR SI TIENE AMIGOS EN COMUN EN EL ARREGLO CON ALGUN SOLICITANTE
	public function es_paciente_de($user_id)
	{
		if (in_array($user_id, $this-> amigos_ids())) 
		{
			return 1;
		} 
		else
		{
			return 0;
		}
	}

// METODO QUE LISTA SOLICITUDES DE AMISTAD PENDIENTES POR APROBAR
	public function solicitudes_pendientes()
	{
		$users =  array( );

		$relaciones = Relacion::where('status',0)->where('user_solicitante', $this->id)->get();

		foreach ($relaciones as $amistad): 
			
			array_push($users,\App\User::find($amistad->solicitud) );
		endforeach;

		return $users;
	}




// METODO QUE RETORNA AGREGLO CON EL ID DE LOS AMIGOS DEL USUARIO
	
	public function solicitudes_pendientes_ids()
	{
		return  collect($this->solicitudes_pendientes())->pluck('id')->toArray();
	}

// METODO QUE RETORNA ARREGLO CON LAS SOLICItuDES DE AMISTAD ENVIADAS POR UN USUARIO
	public function solicitud_de_relacion_enviadas()
	{
		$users =  array( );

		$amistades = Relaciones::where('status',0)->where('solicitud', $this->id)->get();

		foreach ($amistades as $amistad): 
			
			array_push($users,\App\User::find($amistad->user_solicitante) );
		endforeach;

		return $users;
	}

//METODO QUE RETORNA ARREGLO CCON EL ID DE LAS SOLICITUDES DE AMISTAD ENVIADAS 
	public function solicitud_de_relacion_enviadas_ids()
	{
		return  collect($this->solicitud_de_relacion_enviadas())->pluck('id')->toArray();
	}


//METODO PARA RETORNAR UNA NOTIFICACION DE SOLICITUD DE AMISTAD PENDIENTE
	public function Tiene_una_solicitud_de_relacion_pendiente_de($user_id)
	{
		if (in_array($user_id, $this->solicitudes_pendientes_ids())) 
		{
			return 1;
		} 
		else
		{
			return 0;
		}
	}

//METODO QUE RETORNA UNA NOTIFICACION DE SOLICITUD DE AMISTAD ENVIADA PENDENTE POR RESPONDER
	public function  Tiene_una_solicitud_de_relacion_pendiente_enviada_a($user_id)
	{
		if (in_array($user_id, $this->solicitud_de_relacion_enviadas_ids())) 
		{
			return 1;
		} 
		else
		{
			return 0;
		}
	}
}