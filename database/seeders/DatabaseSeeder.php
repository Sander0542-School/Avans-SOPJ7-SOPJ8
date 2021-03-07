<?php

namespace Database\Seeders;

use App\Models\Domain;
use App\Models\Layer;
use App\Models\LayerChoice;
use App\Models\Subject;
use App\Models\SubjectChoice;
use Faker\Generator;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private const Domains = [
        'Gebied 1' => [
            'Koude kant',
            'Het liefdes nest',
            'Eigen weg',
            'Het oude nest',
            'Samen land',
            'Rustige weide',
            'Steile helling',
            'speelweide',
        ],
        'Gebied 2' => [
            'Rechte pad',
            'Financiële moeras',
            'Politiek oerwoud',
            'De nabije omgeving',
        ],
        'Gebied 3' => [
            'Sparrenbos',
            'Marktplaats',
            'Ambacht',
        ],
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = app()->make(Generator::class);

        foreach (self::Domains as $domainName => $subjectNames) {
            $domain = Domain::create([
                'name' => $domainName,
                'color' => substr($faker->hexColor, 1, 6),
            ]);

            foreach ($subjectNames as $subjectName) {
                $subject = Subject::create([
                    'domain_id' => $domain->id,
                    'name' => $subjectName,
                ]);

                Layer::factory($faker->numberBetween(1, 3))->afterCreating(function (Layer $layer2) use ($faker, $subject) {
                    SubjectChoice::create([
                        'name' => $faker->word,
                        'description' => $faker->text(10),
                        //'icon' => $faker->fontAwesomeIcon(),
                        'icon' => 'home',
                        'subject_id' => $subject->id,
                        'layer_id' => $layer2->id,
                    ]);

                    Layer::factory($faker->numberBetween(1, 3))->afterCreating(function (Layer $layer3) use ($faker, $layer2) {
                        LayerChoice::create([
                            'parent_layer_id' => $layer2->id,
                            'child_layer_id' => $layer3->id,
                        ]);

                        Layer::factory($faker->numberBetween(1, 3))->afterCreating(function (Layer $layer4) use ($faker, $layer3) {
                            LayerChoice::create([
                                'parent_layer_id' => $layer3->id,
                                'child_layer_id' => $layer4->id,
                            ]);
                        })->create();
                    })->create();
                })->create();
            }
        }
    }
}
