<?php

namespace App\Repos;

use App\Models\Keyword;
use App\Models\Question;
use App\Repos\Interfaces\QuestionRepoInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionRepository implements QuestionRepoInterface{

    public function find_all() {
        return Question::latest()->where('is_public', true)->paginate(10);
    }

    public function find_by_user() {
        return Question::latest()->where('is_public', true)->where('user_id', Auth::id())->paginate(10);
    }

    public function find_by_slug(string $slug) {
        return Question::all()->where('slug', $slug)->first();
    }

    public function find_by_keyword(string $keyword): LengthAwarePaginator {
        // returns all question based on keyword
        return Keyword::all()->where('name', $keyword)->first()->questions()->paginate(10);
    }

    public function store_question(Request $request, $data): void {
        $question = new Question($data);
        $question->user_id = Auth::id();
        if ($request->has('draft')) {
            $question->save();
        } else {
            $question->is_public = true;
            $question->save();
        }
        $question->generateSlug();
        $question->save();

        $keywords = explode(' ', $data['keywords']);
        $keywordIds = [];
        foreach ($keywords as $keyword) {
            $keyword_instance = Keyword::firstOrCreate(['name' => $keyword]);
            $keywordIds[] = $keyword_instance->id;
        }
        $question->keyword()->sync($keywordIds);
    }

    public function find_all_draft_questions_by_user() {
        return Question::latest()
            ->where('is_public', false)
            ->where('user_id', Auth::id())
            ->paginate(10);
    }

    public function update_question(Request $request, Question $question): void {
        $question->title = $request->input('title');
        $question->body = $request->input('body');
        if ($request->has('draft')) {
            $question->save();
        } else {
            $question->is_public = true;
            $question->save();
        }
        $keywords = explode(' ', $request->input('keywords'));
        $keywordIds = [];
        foreach ($keywords as $keyword) {
            $keyword_instance = Keyword::firstOrCreate(['name' => $keyword]);
            $keywordIds[] = $keyword_instance->id;
        }
        $question->keyword()->sync($keywordIds);
    }

    public function delete($id): bool {
        $question = Question::find($id);
        if (!$question) return false;
        $question->delete();
        return true;
    }
}
