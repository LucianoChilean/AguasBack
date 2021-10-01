<?php

namespace App\Http\Controllers;


use App\Models\permisos;
use Illuminate\Http\{Request, Response};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PermisoController extends Controller
{
    
    public function index(){
        return permisos::all();
    }

    public function detail($id){

        $permiso = permisos::find($id);

        if(is_object($permiso)){

            $data = array(
                'code'   => 200,
                'status' => 'success',
                'user'   => $permiso
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

    public function create(Request $request){
    
        $json = $request->input('json',null);
        $params = json_decode($json); //objeto
        $params_array = json_decode($json, true);//array
       
        $params_array = array_map('trim', $params_array);

      
        if(!empty($params) && !empty($params_array)){

        $validate = \validator($params_array,[
            'nombre'                  => 'required|alpha',
            'descripcion'             => 'regex:/^[\pL\s\-]+$/u',
            'id_padre'                => 'numeric|min:0|max:50'
        ]);

    
        if($validate->fails()){
            $data = array(
                'status'   => 'error',
                'code'     => 404,
                'message'  => 'Datos incorrectos',
                'errors'   => $validate->errors()
            );
        }else{
          
            //Crear permiso
            $permisos = new permisos();
            $permisos->nombre                = $params_array['nombre'];
            $permisos->descripcion           = $params_array['descripcion'];
            $permisos->icono                 = $params_array['icono'];
            $permisos->id_padre              = $params_array['id_padre'];

            $permisos->save();

            $data = array(
                'status'   => 'success',
                'code'     => 200,
                'message'  => 'Permiso Creado Correctamente'
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

    public function update(Request $request){

        $json = $request->input('json',null);
        $params = json_decode($json); //objeto
        $params_array = json_decode($json, true);//array
       
        $params_array = array_map('trim', $params_array);

        if(!empty($params) && !empty($params_array)){

            $validate = \validator($params_array,[
                'nombre'                  => 'required|alpha',
                'descripcion'             => 'regex:/^[\pL\s\-]+$/u',
                'id_padre'                => 'numeric|min:0|max:50'
            ]);
    
        
            if($validate->fails()){
                $data = array(
                    'status'   => 'error',
                    'code'     => 404,
                    'message'  => 'Datos incorrectos',
                    'errors'   => $validate->errors()
                );

            }else{
              
                //Crear permiso
                permisos::where('id',$params_array['id'])->update($params_array);
  
                $data = array(
                    'code'    => 200,
                    'status'  => 'success',
                    'changes' => $params_array
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


    public function delete(Request $request, $id){
        $user = permisos::find($id);

        if(is_object($user)){

            $data = array(
                'code'      => 200,
                'status'    => 'success',
                'message'   => 'Permiso a sido eliminado'
            );

            $user->delete();

        }else{
            $data = array(
                'code'      => 404,
                'status'    => 'error',
                'message'   => 'Permiso no existe'
            );
        }

        return response()->json($data, $data['code']);
        
    }

}
