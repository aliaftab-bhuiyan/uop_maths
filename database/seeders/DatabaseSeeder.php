<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Keyword;
use App\Models\Like;
use App\Models\Question;
use App\Models\Solution;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(5)->create();
        $questions = Question::factory(150)->create();
        $solutions = Solution::factory(400)->create();
        $keywords = Keyword::factory(20)->create();
        $userIds = User::pluck('id')->all();
        $questionIds = Question::pluck('id')->all();
        foreach ($questions as $question) {
            $question->keyword()->sync(Keyword::inRandomOrder()->first()->id);
        }
    }
}
