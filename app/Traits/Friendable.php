<?php

namespace App\Traits;
use App\Amistad;
trait Friendable
{
	// METODO PARA SOLICITAR AGREGAR UN NUEVO AMIGO
	public function agregar_amigo($user_solicitante_id)
	{

		if ($this->id === $user_solicitante_id) {
			return 0;
		}

		if ($this->Tiene_una_solicitud_de_amistad_pendiente_enviada_a($user_solicitante_id)===1) {
			return "Ya existe una solicitud enviada a ese usuario";
		}

		if ($this->Tiene_una_solicitud_de_amistad_pendiente_de($user_solicitante_id)===1) {
			return $this->aceptar_amigo($user_solicitante_id);
		}

		if ($this->es_amigo_de($user_solicitante_id)===1) {
			return "Ya son amigos";
			
		}

		$amistad = Amistad::create([

			'solicitud' => $this->id,
			'user_solicitante'=> $user_solicitante_id
		]);

		if ($amistad)
		 {

			return 1;
		}

			return 0;
	}


// METODO PARA ACEPTAR UN AMIGO NUEVO
	public function aceptar_amigo($solicitud)
	{
		if ($this->Tiene_una_solicitud_de_amistad_pendiente_de($solicitud)===0) {
			return 0;
		}

		$amistad = Amistad::where('solicitud', $solicitud)
							->where('user_solicitante', $this->id)
							->first();

		if ($amistad) 
		{
			
			$amistad->update([

				'status' => 1

			]);

			return 1;
		}

			return 0;

	}


// METODOOOO LISTA DE AMiGOS
	public function amigos()
	{
		$amigos =  array( );

		$f1 = Amistad::where('status',1)->where('solicitud', $this->id)->get();

		foreach ($f1 as $amistad): 
			
			array_push($amigos,\App\User::find($amistad->user_solicitante) );
		endforeach;
		
		$amigos2 =  array( );

		$f2 = Amistad::where('status',1)->where('user_solicitante', $this->id)->get();

		foreach ($f2 as $amistad): 
			
			array_push($amigos2,\App\User::find($amistad->solicitud) );
		endforeach;


		return array_merge($amigos,$amigos2);
		
	}

	//METODO QUE RETORNA ARREGLO CCON EL ID DE LAS AMIGOS DEL USUSARIO 
	public function amigos_ids()
	{
		return  collect($this->amigos())->pluck('id')->toArray();
	}


//METODO PARA RETORNAR SI TIENE AMIGOS EN COMUN EN EL ARREGLO CON ALGUN SOLICITANTE
	public function es_amigo_de($user_id)
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

		$amistades = Amistad::where('status',0)->where('user_solicitante', $this->id)->get();

		foreach ($amistades as $amistad): 
			
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
	public function solicitud_de_amistad_enviadas()
	{
		$users =  array( );

		$amistades = Amistad::where('status',0)->where('solicitud', $this->id)->get();

		foreach ($amistades as $amistad): 
			
			array_push($users,\App\User::find($amistad->user_solicitante) );
		endforeach;

		return $users;
	}

//METODO QUE RETORNA ARREGLO CCON EL ID DE LAS SOLICITUDES DE AMISTAD ENVIADAS 
	public function solicitud_de_amistad_enviadas_ids()
	{
		return  collect($this->solicitud_de_amistad_enviadas())->pluck('id')->toArray();
	}


//METODO PARA RETORNAR UNA NOTIFICACION DE SOLICITUD DE AMISTAD PENDIENTE
	public function Tiene_una_solicitud_de_amistad_pendiente_de($user_id)
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
	public function  Tiene_una_solicitud_de_amistad_pendiente_enviada_a($user_id)
	{
		if (in_array($user_id, $this->solicitud_de_amistad_enviadas_ids())) 
		{
			return 1;
		} 
		else
		{
			return 0;
		}
	}
}