<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Group::truncate();

        $faker = \Faker\ModelFactory::create();

        for ($i = 0; $i < 50; $i ++) {
            Group::create([
                'name' => $faker->name,
                'description' => $faker->paragraph,
            ]);
        }
    }
}
