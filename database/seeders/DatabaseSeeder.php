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
            ['Koude kant', 52.116256, 6.594441],
            ['Het liefdes nest', 52.113052, 6.602479],
            ['Eigen weg', 52.113462, 6.611401],
            ['Het oude nest', 52.114807, 6.591480],
            ['Samen land', 52.111188, 6.604755],
            ['Rustige weide', 52.111300, 6.613009],
            ['Steile helling', 52.113574, 6.586973],
            ['Speelweide', 52.113290, 6.582111],
            ['De vergezichten', 52.112325, 6.596835],
        ],
        'Gebied 2' => [
            ['Rechte pad', 52.120367, 6.600836],
            ['Financiële moeras', 52.118978, 6.604421],
            ['Politiek oerwoud', 52.116388, 6.604725],
            ['De nabije omgeving', 52.121065, 6.594741],
        ],
        'Gebied 3' => [
            ['Sparrenbos', 52.118918, 6.586781],
            ['Marktplaats', 52.118575, 6.591566],
            ['Ambacht', 52.117627, 6.581910],
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
        $orderId = 0;

        foreach (self::Domains as $domainName => $subjectNames) {
            $domain = Domain::create([
                'name' => $domainName,
                'color' => substr($faker->hexColor, 1, 6),
            ]);

            foreach ($subjectNames as $subjectName) {
                $subject = Subject::create([
                    'domain_id' => $domain->id,
                    'name' => $subjectName[0],
                    'order' => ++$orderId,
                    'lat' => $subjectName[1],
                    'lon' => $subjectName[2],
                ]);

                Layer::factory($faker->numberBetween(1, 3))->afterCreating(function (Layer $layer2) use ($faker, $subject) {
                    SubjectChoice::create([
                        'name' => $faker->word,
                        'description' => $faker->text(10),
                        'icon' => $faker->fontAwesomeIcon(),
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

        $this->call([
            PermissionsSeeder::class
        ]);
    }
}
