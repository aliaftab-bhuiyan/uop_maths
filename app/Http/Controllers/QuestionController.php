<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['feed', 'detail_question', ]);
    }

    public function detail_question(string $slug): View
    {
        $question = Question::all()
            ->where('slug', $slug)
            ->first();
        return \view('question.details', compact('question'));
    }
    public function feed(): View
    {
        $questions = Question::orderBy('updated_at', 'desc')->paginate(10);
        return \view('index', compact('questions'));
    }
    public function find_by_keyword_feed(Keyword $keyword): View
    {
        $questions = $keyword->questions()->paginate(10);
        return view('question.keyword', compact('questions'));
    }
    public function ask_question() :View
    {
        return \view('question.ask');
    }

    public function store_question(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|min:10'
        ]);
        $question = new Question($data);
        $question->user_id = Auth::id();
        $question->generateSlug();
        $question->save();

        $keywords = explode(' ', $request->input('keywords'));
        $keywordIds = [];

        foreach ($keywords as $keyword) {
            $tag = Keyword::firstOrCreate(['name' => $keyword]);
            $keywordIds[] = $tag->id;
        }

        $question->keyword()->sync($keywordIds);

        return redirect()->route('show_question')->with('success', 'New question has been published now.');
    }
    public function show_question(): View
    {
        $questions = Question::all()
            ->sortByDesc('updated_at')
            ->where('user', Auth::user());
        return \view('question.show', compact('questions'));
    }
    public function destroy_question(Request $request, $id): RedirectResponse
    {
        $post = Question::findOrFail($id);
        $post->delete();
        return redirect()->route('feed')->with('success', 'Question deleted successfully');
    }
}
