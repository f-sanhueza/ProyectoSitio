<?php

use App\Professor;
use Illuminate\Database\Seeder;

class ProfessorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $professor = [
            [
                'id' => 1,
                'names' => 'Jorge Daniel',
                'surnames' => 'Torres Sosa',
                'department' => 'Informatica',
                'specialty' => 'Base de datos'
            ],
            [
                'id' => 2,
                'names' => 'Jacob Ethan',
                'surnames' => 'Perez Martinez',
                'department' => 'Informatica',
                'specialty' => 'Inteligencia de Negocio'
            ],
            [
                'id' => 3,
                'names' => 'Helena Raquel',
                'surnames' => 'Acosta Benitez',
                'department' => 'Informatica',
                'specialty' => 'Programacion Web'
            ],
            [
                'id' => 4,
                'names' => 'Gabriel Emilio',
                'surnames' => 'Ruiz Flores',
                'department' => 'Informatica',
                'specialty' => 'Programacion Movil'
            ],
            [
                'id' => 5,
                'names' => 'Lucia Valeria',
                'surnames' => 'Herrera Suarez',
                'department' => 'Salud',
                'specialty' => 'Psicologia'
            ],
            [
                'id' => 6,
                'names' => 'Jonathan Antonio',
                'surnames' => 'Flores Medina',
                'department' => 'Salud',
                'specialty' => 'Fonoaudiologia'
            ],
            [
                'id' => 7,
                'names' => 'David Miguel',
                'surnames' => 'Ortiz Juarez',
                'department' => 'Salud',
                'specialty' => 'Veterinaria'
            ],
            [
                'id' => 8,
                'names' => 'Adrian Hugo',
                'surnames' => 'Rios Morales',
                'department' => 'Administracion y Negocios',
                'specialty' => 'Finanzas'
            ],
            [
                'id' => 9,
                'names' => 'Pablo Mario',
                'surnames' => 'Molina Gimenez',
                'department' => 'Administracion y Negocios',
                'specialty' => 'Marketing'
            ],
            [
                'id' => 10,
                'names' => 'Javiera Sofia',
                'surnames' => 'Castillo Muñoz',
                'department' => 'Administracion y Negocios',
                'specialty' => 'Recursos Humanos'
            ],
            [
                'id' => 11,
                'names' => 'Claudia Sara',
                'surnames' => 'Godoy Ojeda',
                'department' => 'Administracion y Negocios',
                'specialty' => 'Produccion'
            ],
            [
                'id' => 12,
                'names' => 'Maria Jose',
                'surnames' => 'Navarro Villalba',
                'department' => 'Construccion',
                'specialty' => 'Sistema de calefaccion y climatizacion'
            ],
            [
                'id' => 13,
                'names' => 'Cristina Beatriz',
                'surnames' => 'Paz Miranda ',
                'department' => 'Construccion',
                'specialty' => 'Suelos'
            ],

        ];
        Professor::insert($professor);

    }
}
