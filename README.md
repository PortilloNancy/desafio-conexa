# desafio-conexa

Endpoints:

Register
POST base_url/register
    json data:
    {
        "email": "example@gmail.com",
        "name" : "name",
        "password": "xxxxxx"
    }

nota: Pon un correo real y te llegará un mail con toda la info sobre el desafío.

Login
POST base_url/login
    form data:
    email: example@gmail.com
    passoword: xxxxxxx

nota: En la respuesta obtendrás el token para acceder a los otros enpoints del desafío.

People
GET base_url/api/people

nota: Devuelve en un array de objetos con todos los personajes con un limit=5 y offset= 0 por default. Podemos alterar estos valores pasandolor por parametro en la url ?limit=?&ofsset=?.

GET base_url/api/people/{id}

nota: Devuelve un Json con los datos del personaje en cuestion. A este endpoint le agregué también la reestucturacion de la data para que la misma traiga los valores de los nombres de del planeta, los films, los vehículos, etc. De esta manera está lista para el consumo de la data en front en el casi de querer solo mostrar la información omitiendo remplazando las urls por la información precisa.

Planets
GET base_url/api/planets

nota: Devuelve en un array de objetos con todos los planetas con un limit=5 y offset= 0 por default. Podemos alterar estos valores pasandolor por parametro en la url ?limit=?&ofsset=?.

GET base_url/api/planet/{id}

nota: Devuelve un Json con los datos del planeta en cuestion.

Vehicles
GET base_url/api/vehicles

nota: Devuelve en un array de objetos con todos los vehículos con un limit=5 y offset= 0 por default. Podemos alterar estos valores pasandolor por parametro en la url ?limit=?&ofsset=?.

GET base_url/api/vehicle/{id}

nota:Devuelve un Json con los datos del vehículo en cuestion.