<?php

namespace App\Http\Controllers;

use App\Models\detalle;
use Illuminate\Http\{Request, Response};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DetalleController extends Controller
{
    public function index(){
        return detalle::all();
    }

    public function detail($id){

        $perfil = detalle::find($id);

        if(is_object($perfil)){

            $data = array(
                'code'   => 200,
                'status' => 'success',
                'perfil'   => $perfil
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
            'descripcion'             => 'regex:/^[\pL\s\-]+$/u'
        ]);

    
        if($validate->fails()){
            $data = array(
                'status'   => 'error',
                'code'     => 404,
                'message'  => 'Datos incorrectos',
                'errors'   => $validate->errors()
            );
        }else{
          
            //Crear Perfiles
            $permisos = new detalle();
            $permisos->nombre                = $params_array['nombre'];
            $permisos->descripcion           = $params_array['descripcion'];

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
                'descripcion'             => 'regex:/^[\pL\s\-]+$/u'
            ]);
    
        
            if($validate->fails()){
                $data = array(
                    'status'   => 'error',
                    'code'     => 404,
                    'message'  => 'Datos incorrectos',
                    'errors'   => $validate->errors()
                );

            }else{
              
                //Actualiza Perfil
                detalle::where('id',$params_array['id'])->update($params_array);
  
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
        $user = detalle::find($id);

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
