<?php

use App\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $student = [

            [
                'id' => 1,
                'studname' => 'Francisco',
                'surname1' => 'Sanhueza',
                'surname2' => 'Cid',
                'region' => 'Araucania',
                'city' => 'Temuco'
            ],
            [
                'id' => 2,
                'studname' => 'Jorge',
                'surname1' => 'Diaz',
                'surname2' => 'Sanchez',
                'region' => 'Los Lagos',
                'city' => 'Frutillar'
            ],
            [
                'id' => 3,
                'studname' => 'Julia',
                'surname1' => 'Garcia',
                'surname2' => 'Ruiz',
                'region' => 'Los Lagos',
                'city' => 'Osorno'
            ],
            [
                'id' => 4,
                'studname' => 'Sofía',
                'surname1' => 'Lopez',
                'surname2' => 'Gomez',
                'region' => 'Los Rios',
                'city' => 'Panguipulli'
            ],
            [
                'id' => 5,
                'studname' => 'Carmen',
                'surname1' => 'Blanco',
                'surname2' => 'Moreno',
                'region' => 'Los Rios',
                'city' => 'Valdivia'
            ],
            [
                'id' => 6,
                'studname' => 'Hector',
                'surname1' => 'Torres',
                'surname2' => 'Vazquez',
                'region' => 'Los Rios',
                'city' => 'Corral'
            ],
            [
                'id' => 7,
                'studname' => 'Felipe',
                'surname1' => 'Motoya',
                'surname2' => 'Cabrera',
                'region' => 'Los Lagos',
                'city' => 'Puerto Montt'
            ],
            [
                'id' => 8,
                'studname' => 'Martin',
                'surname1' => 'Cruz',
                'surname2' => 'Nuñez',
                'region' => 'Araucania',
                'city' => 'Nueva Imperial'
            ],
            [
                'id' => 9,
                'studname' => 'Felix',
                'surname1' => 'Montero',
                'surname2' => 'Bravo',
                'region' => 'Araucania',
                'city' => 'Pitrufquen'
            ],
            [
                'id' => 10,
                'studname' => 'Daniela',
                'surname1' => 'Acosta',
                'surname2' => 'Sandoval',
                'region' => 'Araucania',
                'city' => 'Temuco'
            ],
            [
                'id' => 11,
                'studname' => 'Lucas',
                'surname1' => 'Smith',
                'surname2' => 'Johnson',
                'region' => 'Araucania',
                'city' => 'Victoria'
            ],
            [
                'id' => 12,
                'studname' => 'Victor',
                'surname1' => 'Quezada',
                'surname2' => 'Morales',
                'region' => 'Araucania',
                'city' => 'Villarrica'
            ],
            [
                'id' => 13,
                'studname' => 'Guillermo',
                'surname1' => 'Arango',
                'surname2' => 'Carbajal',
                'region' => 'Araucania',
                'city' => 'Lautaro'
            ],
            [
                'id' => 14,
                'studname' => 'Jose',
                'surname1' => 'Rivera',
                'surname2' => 'Carrasco',
                'region' => 'Araucania',
                'city' => 'Puerto Saavedra'
            ],

        ];


        Student::insert($student);
    }
}
