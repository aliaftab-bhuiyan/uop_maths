<?php

namespace App\Http\Controllers;

use App\Repos\Interfaces\QuestionRepoInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class QuestionController extends Controller
{
    private QuestionRepoInterface $question_repo;
    public function __construct(QuestionRepoInterface $repo) {
        $this->question_repo = $repo;
        $this->middleware('auth')->except(['feed']);
    }
    public function feed(): View {
        $questions = $this->question_repo->find_all();
        return view('index', compact('questions'));
    }

    public function draft_question(): View {
        $draft_questions = $this->question_repo->find_all_draft_questions_by_user();
        return view('question.draft', compact('draft_questions'));
    }
    public function detail_question(string $slug): View {
        $question = $this->question_repo->find_by_slug($slug);
        return view('question.detail', compact('question'));
    }
    public function find_by_keyword_feed(string $name): View {
        $questions = $this->question_repo->find_by_keyword($name);
        return view('question.keyword', compact('questions', 'name'));
    }
    public function ask_question() :View {
        $draft_questions = $this->question_repo->find_all_draft_questions_by_user();
        return view('question.ask', compact('draft_questions'));
    }
    public function store_question(Request $request): RedirectResponse {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|min:10',
            'keywords' => 'sometimes'
        ], [
            'title.required' => 'Opps! I need a title to perform submit.',
            'body.required' => 'Did you forget to explain this question?',
        ]);
        $this->question_repo->store_question($request, $data);
        if ($request->has('draft')) {
            return redirect()->route('draft_question')->with('success', 'Draft question has been created.');
        }
        return redirect()->route('show_question')->with('success', 'New question has been published now.');
    }

    public function update_question(string $slug): View
    {
        $question = $this->question_repo->find_by_slug($slug);
        return view('question.update', compact('question'));
    }
    public function edit_question(Request $request, string $slug): RedirectResponse {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|min:10',
            'keywords' => 'sometimes'
        ], [
            'title.required' => 'Opps! I need a title to perform submit.',
            'body.required' => 'Did you forget to explain this question?',
        ]);

        $question = $this->question_repo->find_by_slug($slug);
        if (!$question) {
            return redirect()->route('ask_question')->with('error', 'Question not found');
        }
        if ($question->user_id == Auth::id()) {
            $this->question_repo->update_question($request, $question);
            if ($request->has('draft')) {
                return redirect()->route('draft_question')->with('success', 'Draft question has been updated.');
            }
        } else {
            return back()->with('error', 'You are not the owner.');
        }
        return redirect()->route('show_question')->with('success', 'Question has been updated.');
    }
    public function show_question(): View {
        $questions = $this->question_repo->find_by_user();
        return view('question.show', compact('questions'));
    }
    public function destroy_question($id): RedirectResponse
    {
        $this->question_repo->delete($id);
        return redirect()->route('feed')->with('success', 'Question deleted successfully');
    }
}
