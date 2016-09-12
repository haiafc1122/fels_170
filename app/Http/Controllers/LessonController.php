<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Lesson;
use App\Models\Word;
use App\Models\Result;
use Auth;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Auth::user()->lessons;
        return view('lesson.index', compact('lessons'));
    }

    public function show(Lesson $lesson)
    {
        if ($lesson->results->first() == null) {
            $words = Word::orderBy(\DB::raw('RAND()'))->limit(config('settings.paginate.lesson_word'))->get();
            return view('lesson.show', compact('words', 'lesson'));
        } else {
            return view('lesson.result', compact('lesson'));
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required'
        ]);

        $lesson = $request->user()->lessons()->create([
            'category_id' => $request->category_id,
        ]);

        return redirect(url('lesson/' . $lesson->id));
    }

    public function update(Lesson $lesson, Request $request)
    {
        if ($request->word_ids == null) {
            return redirect(url('lesson/' . $lesson->id))->withErrors(trans('messages.finish_error'));
        }
        foreach ($request->word_ids as $word_id) {
            settype($word_id, 'integer');
            $temp = 0;
            if ($request->word_anwser != null) {
                foreach ($request->word_anwser as $key => $wa) {
                    if ($word_id == $key) {
                        $temp = 1;
                    }
                }
            }

            if ($temp == 1) {
                $lesson->results()->create([
                    'word_id' => $word_id,
                    'anwser_id' => $request->word_anwser[$word_id],
                ]);
            } else {
                $lesson->results()->create([
                    'word_id' => $word_id,
                ]);
            }
        }

        return redirect(url('lesson/' . $lesson->id));
    }
}
