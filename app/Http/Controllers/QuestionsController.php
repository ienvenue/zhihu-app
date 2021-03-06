<?php
namespace  App;
namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Question;
use App\Repositories\QuestionRepository;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


/**
 * Class QuestionsController
 * @package App\Http\Controllers
 */
class QuestionsController extends Controller
{
    /**
     * @var QuestionRepository
     */
    protected $questionRepository;

    /**
     * QuestionsController constructor.
     * @param QuestionRepository $questionRepository
     */
    public function __construct(QuestionRepository $questionRepository)
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->questionRepository=$questionRepository;

    }


    /**
     * Display a listing of the resource.
     *

     */
    public function index()
    {
        $questions= $this->questionRepository->getQuestionsFeed();
        return view('questions.index',compact('questions'));
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
        $topics=$this->questionRepository->normalizeTopics( $request->get('topics'));

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
        $question = $this->questionRepository->create($data);
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
        $question = $this->questionRepository->byIdWithTopicsAndAnswers($id);
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
        $question =$this->questionRepository->byId($id);
        if(Auth::user()->owns($question))
        {
            return view('questions.edit',compact('question'));
        }
        else
            return back();
    }


    /**
     * @param StoreQuestionRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreQuestionRequest $request, $id)
    {

        $question = $this->questionRepository->byId($id);
        $topics=$this->questionRepository->normalizeTopics( $request->get('topics'));
        $question->update([
            'title' => $request->get('title'),
            'body' => $request->get('body'),
        ]);

        $question->topics()->sync($topics);
        return redirect()->route('questions.show', [$question->id]);

    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy($id)
    {
        $question = $this->questionRepository->byId($id);
        if (Auth::user()->owns($question))
        {
            $question->delete();
            return redirect('/');
        }
        else
            return back();
    }

}
