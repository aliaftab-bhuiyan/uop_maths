<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like($id)
    {
        $user = auth()->id();
        $question = Question::all()->where('id', $id)->first();
        if (!$question->likes()->where('user_id', $user)->exists()) {
            $question->likes()->attach($user);
        }

        return redirect()->back();
    }

    public function unlike($id)
    {
        $user = auth()->id();
        $question = Question::all()->where('id', $id)->first();
        if ($question->likes()->where('user_id', $user)->exists()) {
            $question->likes()->detach($user);
        }

        return redirect()->back();
    }
}
