//como manejar arreglos en laravel?   
<!--DELIMITER-->El método Arr::add agrega valores a un arreglo. Ejemplo:
<?php

$info = ['nombre' => 'Rafael'];
$info = Arr::add($info, 'numero', 6);

print_r($info);
// ['nombre' => 'Rafael', 'numero' => 6]

<!--DELIMITER-->Este método permite unir dos arreglos, por ejemplo:
<?php

$nombres   = ['nombre' => 'Rafael'];
$telefonos = ['telefono' => '5353647'];
$datos = Arr::collapse([$nombres, $telefonos]);

print_r($datos);
// ['nombre' => 'Rafael', 'telefono' => '5353647']

<!--DELIMITER-->El método Arr::divide retorna dos arreglos, uno va a contener todas las llaves y el otro tendrá todos los valores del arreglo:
<?php

[$keys, $values] = Arr::divide(['nombre' => 'Rafael']);

print_r($keys);
// ['nombre'] 

print_r($values);
// ['Rafael']

<!--DELIMITER-->El método Arr::dot cambia los arreglos multidimensionales en arreglos simples, utilizando un punto «.» para indicar el nivel de profundidad de los valores, ejemplo:
<?php

$datos = Arr::dot(['carro' => ['marca' => 'honda', 'color' => 'negro']]);

print_r($datos);    
// ['carro.marca' => 'honda', 'carro.color' => 'negro']

<!--DELIMITER-->El método Arr::except nos devuelve los valores del arreglo exceptuando el valor de la llave que pasamos como parámetro:
<?php

$datos = ['marca' => 'honda','color' => 'negro'];
$filtro = Arr::except($datos, ['color']);

print_r($filtro);    
// ['marca' => 'honda']

<!--DELIMITER-->El método Arr::first regresa el primer elemento de un array que cumpla una condición dada, por ejemplo:
<?php

$digits = [34, 56, 75];

$first = Arr::first($digits, function ($value, $key ) {
    return $value >= 40;
});

print_r($first);
// 56

<!--DELIMITER-->El método Arr::flatten convierte un arreglo multidimensional en uno simple, ejemplo:
<?php

$info = ['nombre' => 'Rafael', 'Carro' => ['Audi', 'Azul']];
$datos = Arr::flatten($info);

print_r($datos);
// ['Rafael', 'Audi', 'Azul']

<!--DELIMITER-->El método Arr::forget elimina una llave dada, se utiliza la notación de puntos para identificar la profundidad del arreglo. Como primer parámetro recibe el arreglo y como segundo parámetro la llave que queremos olvidar, por ejemplo:
<?php

$info = ['users' => ['admin' => 'Rafael', 'editor' => 'Luis']];
Arr::forget($info, 'users.editor');

print_r($info);
// ['users' => ['admin' => 'Rafael']]

<!--DELIMITER-->El método Arr::get nos devuelve un valor deseado. Recibe como primer parámetro el arreglo, y como segundo parámetro, la llave del valor que queramos devolver (utiliza la notación de puntos para identificar la profundidad del arreglo), por ejemplo:
<?php

$info = ['users' => ['admin' => 'Rafael', 'editor' => 'Luis']];
$admin = Arr::get($info, 'users.admin');

print_r($admin);
// Rafael

<!--DELIMITER-->Este método comprueba si existe un determinado elemento y retorna un valor booleano (utiliza la notación de puntos para identificar la profundidad del arreglo), por ejemplo:
<?php

$info = ['users' => ['admin' => 'Rafael', 'editor' => 'Luis']];
$admin = Arr::has($info, 'users.admin');
    
print_r($admin);
// 1

<!--DELIMITER-->El método Arr::only solo nos devolverá aquellas llaves que especifiquemos dentro de un arreglo, ejemplo:
<?php

$info = ['nombre' => 'Laptop', 'precio' => 100, 'unidades' => 10];
$datos = Arr::only($info, ['nombre', 'unidades']);

print_r($datos);
// ['nombre' => 'Laptop', 'unidades' => 10]

<!--DELIMITER-->Este método devuelve un arreglo formado por los valores de una llave dada perteneciente a otro arreglo, se puede utilizar la notación de puntos. Por ejemplo:
<?php

$info = [
    ['carro' => ['id' => 1, 'color' => 'Azul']],
    ['carro' => ['id' => 2, 'color' => 'Verde']],
];
$color = Arr::pluck($info, 'carro.color');

print_r($color);
// ['Azul', 'Verde']

<!--DELIMITER-->Agrega un item al principio del arreglo, ejemplo:
<?php

$numeros = ['uno', 'dos', 'tres', 'cuatro'];
$numeros = Arr::prepend($numeros, 'cero');

print_r($numeros);
// ['cero', 'uno', 'dos', 'tres', 'cuatro']

<!--DELIMITER-->Este método toma el valor de una llave determinada y luego la borra del arreglo, ejemplo:
<?php

$info = ['mascota' => 'perro', 'instrumento' => 'guitarra'];
$mascota = Arr::pull($info, 'mascota');

print_r($mascota);
// ['perro']

print_r($info);
// ['instrumento' => 'guitarra']

<!--DELIMITER-->El método Arr::set se utiliza para cambiar el valor de un llave determinada en un arreglo, ejemplo:
<?php

$info = ['productos' => ['carro' => ['color' => 'azul']]];
Arr::set($info, 'productos.carro.color', 'rosa');

print_r($info);
// ['productos' => ['carro' => ['color' => 'rosa']]]

<!--DELIMITER-->El método Arr::sort ordena un arreglo por sus valores. Ejemplo:
<?php

$data = ['Moises', 'Ana', 'Erick'];
$orden = Arr::sort($data);

print_r($orden);
// ['Ana', 'Erick', 'Moises']

<!--DELIMITER-->El método Arr::where devuelve un arreglo con los elementos que pasen el filtro dado, como, por ejemplo, retornar los valores del arreglo que sean de tipo string:
<?php

$array = [100, '200', 300, '400', 500];

$filtered = Arr::where($array, function ($value, $key) {
    return is_string($value);
});

print_r($filtered);
// [1 => '200', 3 => '400']

<!--DELIMITER-->Esta función regresa el primer elemento de un arreglo, ejemplo:
<?php

$array = [100, 200, 300];
$primero = head($array);
    
print_r($primero);
// 100

<!--DELIMITER-->Esta función regresa el último elemento de un arreglo, ejemplo:
<?php

$array = [100, 200, 300];
$ultimo = last($array);

print_r($ultimo);
// 300

