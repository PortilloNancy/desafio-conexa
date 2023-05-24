<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* se crea un controlador padre que se encarga de las peticiones del curl */

class CurlsController extends Controller
{
    /* obtiene todos los registros*/
    public function getAll(string $url, int $limit , int $offset){

        try {

            // obtiene los datos de la api externa via curl
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
    
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
            $response = json_decode(curl_exec($curl));
    
            $status_code= curl_getinfo($curl, CURLINFO_HTTP_CODE);

           
            if(!$response){
              
                $error = curl_error($curl);

                return response()->json([
                    'message' => $error,  
                    'status' => $status_code
                ]);

                curl_close($curl);
            }

            $result_data = $response->results;

            // agrega el limt y offset a la respuest
            $offset = $offset < 0 ? 0: $offset;
            $offset = $offset > count($result_data) ? count($result_data)-1: $offset;

            $limit = $limit < 0 ? 5: $limit;
            $limit = $limit > count($result_data) ? count($result_data): $limit;

            $result = array_slice($result_data, $offset, $limit);

            return response()->json([
                'data'   => $result,  
                'status' => $status_code,
                'limit'  => $limit,
                'offset' => $offset,
                'total'  => count($result_data),
                'total_current_page' =>  count($result),
            ]);
           

            curl_close($curl);

        } catch (\Throwable $th) {
            throw $th;
        }
       

    }

    /* obtiene un solo registro*/
    public function getOne(string $url){

        try {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
    
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
            $response = json_decode(curl_exec($curl));
    
            $status_code= curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if(!$response){
              
                $error = curl_error($curl);

                return response()->json([
                    "error" => $error,
                    "status"  => $status_code
                ]);

                curl_close($curl);

            }else if($status_code == 404){

                $error = curl_error($curl);

                return response()->json([
                    'message'=> "Sin registros",  
                    'status' => $status_code
                ]);

                curl_close($curl);
            }

            curl_close($curl);
            
            return response()->json([
                'data' => $response,  
                'status' => $status_code
            ]);
           

    
        } catch (\Throwable $th) {
            throw $th;
        }

    }
}
