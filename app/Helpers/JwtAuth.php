<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Illuminate\Support\Facades\BD;
use App\Models\User;


class JwtAuth{

    public $key;

    public function __construct(){
        $this->key = 'El secreto esta en el agua 2021 by Iron';
    }

    public function signup($mail,$password,$getToken = null){
        //Buscar si existe usuario
        $user = User::where([
                'mail'     => $mail,
                'password' => $password

        ])->first();
        //Comprobar si son correctos
       $signup = false;

       if(is_object($user)){
        $signup = true;
       }
       
       //Generar Token
       if($signup){
           $token = array(
               'sub'   => $user->id,
               'mail'  => $user->mail,
               'name'  => $user->nombre,
               'iat'   => time(),
               'exp'   => time()+(7*24*60*60)
           );


           $jwt     = JWT::encode($token,$this->key,'HS256');
           $decoded = JWT::decode($jwt,$this->key,['HS256']);

           if(is_null($getToken)){
              $data = $jwt; 
           }else{
              $data = $decoded;
           }


       }else{
        $data = array(
            'status'  => 'error',
            'message' => 'Login incorrecto.'
        );

       }

        return $data;


    }

    public function checkToken($jwt, $getIdentity = false){
        
        $auth = false;

        try{
            
            $jwt = str_replace('"','',$jwt);
            $decoded = JWT::decode($jwt, $this->key, ['HS256']);
        }catch(\UnexpectedValueException $e){
            $auth = false;
        }catch(\DomainException $e){
            $auth = false;
        }

        if(!empty($decoded) && is_object($decoded) && isset($decoded->sub)){
            $auth = true;
        }else{
            $auth = false;
        }

        if($getIdentity){
            return $decoded;
        }
        
        return $auth;

    }


}