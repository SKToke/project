<?php

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Shyamnagar', 'Pirgacha', 'Manikganj', 'Barisal', 'Kulaura', 'Bikrampur', 'Cumilla', 'Savar', 'Mithamoin', 'Itna'];
        for ($i = 0; $i < 10; $i++) {
            Project::create([
                'name' => $names[$i],
                'description' => $names[$i] . ' Description',
                'status' => 'active'
            ]);
        }
    }
}
