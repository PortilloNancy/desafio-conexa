<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\People;

class PeopleController extends CurlsController
{
    public function getAllPeople(Request $request){

        $limit = empty($request->query('limit')) ? 5 : $request->query('limit'); // Obtener el valor del parámetro "limit"
        $offset = empty($request->query('offset')) ? 0 : $request->query('offset'); // Obtener el valor del parámetro "offset"

        $url = "https://swapi.dev/api/people";
        $result = $this->getAll($url, $limit, $offset); // este método se genera en el controlador padre
       
        return  $result;

    }

    public function getOnePeople(string $id){


        $url = "https://swapi.dev/api/people/".$id;

        $data_people = $this->getOne($url);// este método se genera en el controlador padre
        $people = new People; // crear un objeto del tipo people
        
        $data_people = $data_people->getContent();
        $data_people = json_decode($data_people, true);

        // almacenar la respuesta el el nuevo objeto del tipo people
        foreach ($data_people['data'] as $key => $value) {
            $people->$key = $value;
        }

        // obtener el planeta
        $data_homeword = $this->getOne($people->homeworld);
        $data_homeword = $data_homeword->getContent();
        $data_homeword = json_decode($data_homeword, true);
        $people->homeworld = $data_homeword['data']['name'];
 
        // obtener films
        $films = [];
        foreach ($people->films as $value) {
            $data_film = $this->getOne($value);
            $data_film = $data_film->getContent();
            $data_film = json_decode($data_film, true);

            array_push($films,  $data_film['data']['title']);
        }
        $people->setAttribute('films',$films);

        // obtener vehicles
        $vehicles = [];
        foreach ($people->vehicles as $value) {
            $data_vehicle = $this->getOne($value);
            $data_vehicle = $data_vehicle->getContent();
            $data_vehicle = json_decode($data_vehicle, true);

            array_push($vehicles,  $data_vehicle['data']['name']);
        }
        $people->setAttribute('vehicles',$vehicles);

        // obtener starships
        $starships = [];
        foreach ($people->starships as $value) {
            $data_starship = $this->getOne($value);
            $data_starship = $data_starship->getContent();
            $data_starship = json_decode($data_starship, true);

            array_push($starships,  $data_starship['data']['name']);
        }
        $people->setAttribute('starships',$starships);

        // retorna un objeto del tipo people con una respuesta lista para consumir por el front
        return response()->json([
            'people' => $people,  
           
        ]);

    }
}
