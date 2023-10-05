<?php

namespace App\Http\Controllers;

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
        $question = Question::firstWhere('slug', $slug);
        return \view('question.details', compact('question'));
    }
    public function feed(): View
    {
        $questions = Question::all();
        return \view('index', compact('questions'));
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
//
        $result = \auth()->user()->questions()->create($data);
        $result->slug=Question::generateUniqueSlug($request->input('title'));
        return redirect()->route('show_question')->with('success', 'New question has been published now.');
    }
    public function show_question(): View
    {
        $questions = Question::all()
            ->sortByDesc('updated_at')
            ->where('user', Auth::user());
        return \view('question.show', compact('questions'));
    }
}
