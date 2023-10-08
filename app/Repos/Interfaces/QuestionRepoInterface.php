<?php

namespace App\Repos\Interfaces;

use App\Models\Question;
use Illuminate\Http\Request;

interface QuestionRepoInterface
{
    public function find_all();
    public function find_by_user();
    public function find_by_slug(string $slug);
    public function find_by_keyword(string $keyword);
    public function find_all_draft_questions_by_user();
    public function store_question(Request $request, $data);
    public function update_question(Request $request, Question $question);
    public function delete($id);
}
