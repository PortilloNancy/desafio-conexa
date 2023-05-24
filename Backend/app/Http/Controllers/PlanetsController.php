<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlanetsController extends CurlsController
{
    public function getAllPlanets(Request $request){

        $limit = empty($request->query('limit')) ? 5 : $request->query('limit'); // Obtener el valor del parámetro "limit"
        $offset = empty($request->query('offset')) ? 0 : $request->query('offset'); // Obtener el valor del parámetro "offset"

        $url = "https://swapi.dev/api/planets";
        $result = $this->getAll($url, $limit, $offset); // este método se genera en el controlador padre

        return  $result;

    }

    public function getOnePlanet(string $id){


        $url = "https://swapi.dev/api/planets/".$id;

        $result = $this->getOne($url); // este método se genera en el controlador padre

        return  $result;

    }
}
