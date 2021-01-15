<?php 
namespace App\Controllers;
use App\Models\Usuarios;
class Crud extends BaseController
{
	public function index()
	{
        $mensaje = session('mensaje');
		return view('login', ["mensaje" => $mensaje]);
	}

	public function inicio()
	{
		return view('inicio');
	}

	public function login()
	{
		$usuario = $this->request->getPost('usuario');
		$password = $this->request->getPost('password');
		$Usuario = new Usuarios();

		$datosUsuario = $Usuario->obtenerUsuario(['usuario'=>$usuario]);
			
		if (count($datosUsuario) > 0 ){

			$data = [
				"usuario" => $datosUsuario[0]['usuario'],
				"tipo" => $datosUsuario[0]['tipo']
	];
				$session = session();
				$session -> set($data);
				
				return redirect()->to(base_url('/inicio'))->with('mensaje','1');
				
		} else {
		
			return redirect()->to(base_url('/'))->with('mensaje','0');
		}
		
	}

	public function salir()
	{
		$usuario = session();
		$usuario->destroy();
		return redirect()->to(base_url('/'));
	}


	//--------------------------------------------------------------------

}
