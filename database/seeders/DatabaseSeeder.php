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
        [
            'name' => 'Blauw Gebied',
            'color' => '1976D2',
            'subjects' => [
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
        ],
        [
            'name' => 'Rood Gebied',
            'color' => 'D32F2F',
            'subjects' => [
                ['Rechte pad', 52.120367, 6.600836],
                ['Financiële moeras', 52.118978, 6.604421],
                ['Politiek oerwoud', 52.116388, 6.604725],
                ['De nabije omgeving', 52.121065, 6.594741],
            ],
        ],
        [
            'name' => 'Groen Gebied',
            'color' => '2E7D32',
            'subjects' => [
                ['Sparrenbos', 52.118918, 6.586781],
                ['Marktplaats', 52.118575, 6.591566],
                ['Ambacht', 52.117627, 6.581910],
            ],
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

        foreach (self::Domains as $domainData) {
            $domain = Domain::create([
                'name' => $domainData['name'],
                'color' => $domainData['color'],
            ]);

            foreach ($domainData['subjects'] as $subjectData) {
                $subject = Subject::create([
                    'domain_id' => $domain->id,
                    'name' => $subjectData[0],
                    'lat' => $subjectData[1],
                    'lon' => $subjectData[2],
                    'order' => ++$orderId,
                ]);

                Layer::factory($faker->numberBetween(1, 3))->afterCreating(function (Layer $layer2) use ($faker, $subject) {
                    SubjectChoice::create([
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
            PermissionsSeeder::class,
        ]);
    }
}
