<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Solution;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolutionController extends Controller
{
    public function store_solution(Request $request, $id): RedirectResponse
    {
        $data = $request->validate([
            'body' => 'required|string|max:1000'
        ]);
        $question = Question::whereId($id)->first();
        $solution = new Solution($data);
        $solution->user_id = Auth::id();
        $solution->question_id = $question->id;
        $solution->save();

        return redirect()->route('detail_question', ['slug'=> $question->slug]);
    }
}
