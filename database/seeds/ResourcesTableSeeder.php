<?php

use Illuminate\Database\Seeder;

class ResourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Resource::truncate();

        $faker = \Faker\ModelFactory::create();

        for ($i = 0; $i < 10; $i ++) {
            Resource::create([
                'name' => $faker->name,
                'description' => $faker->paragraph,
                'group_id' => $faker->randomDigit
            ]);
        }
    }
}
