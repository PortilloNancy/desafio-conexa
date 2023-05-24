<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\RegisterMailable;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $jsonData = $request->getContent();
        $data = json_decode($jsonData, true);
        
        $validate = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', \Illuminate\Validation\Rules\Password::defaults()],
        ]);
    
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 422);
        }

        // try {
      
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password)
                
            ]);
           
            // enviar correo

            $send_email = new RegisterMailable($request);
            Mail::to($request->email)->send($send_email);

            return response()->json([
                "data" => $user,
                "message" => "registro existoso, corrobore su correo electrónico"
                
            ]);

        // } catch (\Throwable $th) {

        //     return response()->json([
        //         "data" => $th,
        //         "message" => "Error al crear registro"
        //     ]);
        // }
    }
}
