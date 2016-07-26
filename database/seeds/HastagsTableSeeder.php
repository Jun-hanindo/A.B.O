<?php

use App\Models\Hastag;
use Illuminate\Database\Seeder;

class HastagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hastag = new Hastag();
        $hastag->name = 'Musicians';
        $hastag->slug = 'musicians';
        $hastag->save();

        $hastag = new Hastag();
        $hastag->name = 'Dance';
        $hastag->slug = 'dance';
        $hastag->save();

        $hastag = new Hastag();
        $hastag->name = 'Girls';
        $hastag->slug = 'girls';
        $hastag->save();

        $hastag = new Hastag();
        $hastag->name = 'Guys';
        $hastag->slug = 'guys';
        $hastag->save();

        $hastag = new Hastag();
        $hastag->name = 'Singing';
        $hastag->slug = 'singing';
        $hastag->save();

        $hastag = new Hastag();
        $hastag->name = 'Random';
        $hastag->slug = 'random';
        $hastag->save();

        $hastag = new Hastag();
        $hastag->name = 'Learnings';
        $hastag->slug = 'learnings';
        $hastag->save();
    }
}
