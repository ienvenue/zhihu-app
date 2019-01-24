<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Question;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class QuestionsController extends Controller
{
    /**
     * QuestionsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *

     */
    public function index()
    {
        dd(1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.make');
    }


    /**
     * @param StoreQuestionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreQuestionRequest $request)// use Dependency Injection
    {
        $topics=$this->normalizeTopics( $request->get('topics'));

//        $rules=[
//            'title'=>'required|min:6|max:196',
//            'body'=>'required|min:26',
//        ];
//        $messgae=[
//            'title.required'=>'Title can not empty.',
//            'title.min'=>'Title can not less than 6 char.',
//            'body.min'=>'Body can not less than 26 char.',
//            'body.require'=>'Body can not empty.',
//        ];
//        $this->validate($request,$rules,$messgae);
        $data = [
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'user_id' => Auth::id()
        ];
        $question = Question::query()->create($data);
        $question->topics()->attach($topics);
        return redirect()->route('questions.show', [$question->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::query()->where('id',$id)->with('topics')->first();
        return view('questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function normalizeTopics(array $topics)
    {
        return collect($topics)->map(function ($topic) {

            if (is_numeric($topic) && $topic_number = (int)$topic) {
                if ($newTopic = Topic::query()->findOrFail($topic_number)) {
                    $newTopic->increment('questions_count');
                    return $topic_number;
                }

            }

            if ($newTopic = Topic::query()->where('name', $topic)->first()) {
                $newTopic->increment('questions_count');
                return $newTopic->id;
            }

            $newTopic = Topic::query()->create(['name' => $topic, 'questions_count' => 1]);
            return $newTopic->id;
        })->toArray();
    }
}
