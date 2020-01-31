<?php

use Illuminate\Database\Seeder;

/**
 * Class GroupsTableSeeder
 */
class GroupsTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        factory(App\Group::class)->create([
            'name' => 'Красбер'
        ]);

        factory(App\Group::class)->create([
            'name' => 'Ассоциация курортов Крыма'
        ]);
    }
}
