<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\User;

class PerfilController extends Controller
{
     public function index($slug)
    {
    	$user = User::where('slug','=', $slug)->first();
    
    	return view('perfiles.perfil')
    		->with('user', $user);
    }


    public function editar()
    {
    	return view('perfiles.editar')->with('info', Auth::user()->perfil);
    	# code...
    }


    public function update(Request $r)
    {
    	
    	$this->validate($r,[

    		'direccion' => 'required',
    		'informacion' => 'required|max:255'

    		]);

    	Auth::user()->perfil()->update([

    			'direccion' => $r->direccion,
    			'informacion' => $r->informacion
    		]);

    	if ($r->hasFile('avatar')) 
    	{
    		Auth::user()->update([

    				'avatar' => $r->avatar->store('public/avatars')

    			]);
    	}

    	Session::flash('success', 'Perfil Actualizado.');
    	
    	 return redirect()->route('perfil', [Auth::user()]);
    }
}
