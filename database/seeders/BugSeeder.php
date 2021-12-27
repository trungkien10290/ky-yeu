<?php

namespace Database\Seeders;

use App\Models\Bug;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class BugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bug::factory(25)->create()->each(function ($bug) {
            $amount = rand(0, 10);
            if (!empty($amount)) {
                Comment::factory($amount)->create([
                    'bug_id' => $bug->id
                ]);
            }
        });
    }
}
