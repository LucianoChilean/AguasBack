<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\{Request, Response};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
   
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
    
        $json = $request->input('json',null);
        $params = json_decode($json); //objeto
        $params_array = json_decode($json, true);//array
       

        $params_array = array_map('trim', $params_array);

       
        if(!empty($params) && !empty($params_array)){

        $validate = \validator($params_array,[
            'nombre'                  => 'required|alpha',
            'mail'                    => 'required|email|unique:users',
            'apellido_paterno'        => 'required|alpha',
            'apellido_materno'        => 'required|alpha',
            'password'                => 'required'
        ]);

        if($validate->fails()){
            $data = array(
                'status'   => 'error',
                'code'     => 404,
                'message'  => 'Datos incorrectos',
                'errors'   => $validate->errors()
            );
        }else{
            //Cifrado de clave
            $pwd = hash('sha256',$params->password);
            
            //Crear usuario
            $user = new User();
            $user->nombre                = $params_array['nombre'];
            $user->apellido_paterno      = $params_array['apellido_paterno'];
            $user->apellido_materno      = $params_array['apellido_materno'];
            $user->mail                  = $params_array['mail'];
            $user->password              = $pwd;

            $user->save();

            $data = array(
                'status'   => 'success',
                'code'     => 200,
                'message'  => 'Usuario a sido Creado correctamente'
            );

        }

    }else{
        $data = array(
            'status'   => 'error',
            'code'     => 404,
            'message'  => 'Datos enviados de forma incorrecta'
        );

    }

        return response()->json($data, $data['code']);
       
    }

    public function login(Request $request){

        $jwtAuth = new \JwtAuth();

        //Data
        $json         = $request->input('json', null);
        $params       = json_decode($json);
        $params_array = json_decode($json,true);

        //Validar Data
        $validate = \validator($params_array,[
            'mail'      => 'required|email',
            'password'  => 'required'
        ]);

        if($validate->fails()){
            $signup = array(
                'status'   => 'error',
                'code'     => 404,
                'message'  => 'Usuario incorrecto',
                'errors'   => $validate->errors()
            );
        }else{
        //Cifrar clae
            $pwd = hash('sha256',$params->password);
        // Devolver Token o data
            $signup = $jwtAuth->signup($params->mail,$pwd);
            if(!empty($params->gettoken)){
                $signup = $jwtAuth->signup($params->mail,$pwd,true);   
            }


        }

    
        return response()->json($signup, 200);

    }

    public function update(Request $request){

        //Comprobar si el usuario esta identificado
        $token = $request->header('Authorization');
        $jwtAuth = new \JwtAuth();
        $checkToken = $jwtAuth->checkToken($token);

        $json = $request->input('json',null);
        $params_array = json_decode($json, true);


        if($checkToken && !empty($params_array)){
            //Actualizar usuario
      
            $user = $jwtAuth->checkToken($token,true);
        
            $validate = \validator($params_array,[
                'nombre'                  => 'required|alpha',
                'mail'                    => 'required|email|unique:users',
                'apellido_paterno'        => 'required|alpha',
                'apellido_materno'        => 'required|alpha'
            ]);

            //Quitar campos que no quiero actualizar
            unset($params_array['id']);
            unset($params_array['password']);
            unset($params_array['remember_token']);
            unset($params_array['created_at']);

            //Actualizar usuario
            $user_update = User::where('id',$user->sub)->update($params_array);

            $data = array(
                'code'    => 200,
                'status'  => 'success',
                'user'    => $user,
                'changes' => $params_array
            );

        }else{
            $data = array(
                'code'    => 400,
                'status'  => 'error',
                'message' => 'El usuario no esta identificado'
            );
        }

        return response()->json($data,$data['code']);

    }

    public function upload(Request $request){

        $image  = $request->file('file0');

        $validate = \validator($request->all(),[
            'file0' => 'required|image|mimes:jpg,jpeg,png,gif'
        ]);

        if(!$image || $validate->fails()){
            $data = array(
                'code'    => 400,
                'status'  => 'error',
                'message' => 'Error al subir imagen'
            );
        }else{
           $image_name = $image->getClientOriginalName();
           \Storage::disk('users')->put($image_name, \File::get($image));

           $data = array(
               'code'   => 200,
               'status' => 'success',
               'image'  => $image_name
           );

        }

        return response()->json($data,$data['code'])->header('Content-Type', 'text/plain');

    }

    public function getImage($filename){


        $isset = \Storage::disk('users')->exists($filename);

        if($isset){
        $file = \Storage::disk('users')->get($filename);
        return new Response(base64_encode($file), 200);
         
       }else{
        
        $data = array(
            'code'    => 400,
            'status'  => 'error',
            'message' => 'imagen no existe en disco'
        );

        return response()->json($data,$data['code']);
      }
   

    }

    public function detail($id){

        $user = User::find($id);

        if(is_object($user)){

            $data = array(
                'code'   => 200,
                'status' => 'success',
                'user'   => $user
            );

        }else{
            $data = array(
                'code'      => 404,
                'status'    => 'error',
                'message'   => 'usuario no existe'
            );
        }

        return response()->json($data, $data['code']);

    }

    public function delete(Request $request, $id)
    {
        $user = User::find($id);

        if(is_object($user)){

            $data = array(
                'code'      => 200,
                'status'    => 'success',
                'message'   => 'Usuario a sido eliminado'
            );

            $user->delete();

        }else{
            $data = array(
                'code'      => 404,
                'status'    => 'error',
                'message'   => 'usuario no existe'
            );
        }

        return response()->json($data, $data['code']);
        
    }

}
