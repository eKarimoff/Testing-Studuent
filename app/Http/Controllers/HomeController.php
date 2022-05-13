<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Subject;
use App\Models\Result;
use App\Models\User;
use App\Models\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $subjects = Subject::all();

        return view('home', compact('subjects'));
    }

    public function getQuestion($id)
    {

        $questions = Question::with('answers')->inRandomOrder()->where('subject_id',$id)->get();

            return view('tests', compact('questions'));
    }

    // public function next($id) {
    //     $s_id = Question::find($id)->subject_id;
    //     $question = Question::where('id', '>', $id)->where('subject_id', $s_id)->orderBy('id','asc')->pluck('id')->first();
    //     return redirect()->route('tests.get', $question->id);
    // }

    public function store(Request $request)
    {

        $datas = $request->input('answer_id');
        $data1 = $request->input('s_id');
        $natija = 0;
            $data = new Session();
            $data->user_id = auth()->user()->id;
            $data->subject_id = $data1;
            $data->save();
            
        foreach($datas as $key => $value)
        {
            $store = new Result();
            $store->session_id = $data->id;
            $store->answer_id = $value;
            $store->question_id = $key;
            $store->save();

            $natija += Answer::find($value)->is_true;
            $username = User::find(auth()->user()->id) ? User::find(auth()->user()->id)->name : 'User';
        }
        return view('s_result', compact('natija','username'));

    }

    public function getResult()
    {
        $sessions = Session::with('subject')->get();

        return view('session', compact('sessions'));
    }

    public function result($id)
    {
        $sessions = Session::where('user_id',$id)->get();

        return view('session', compact('sessions'));

    }

    public function sessionResult($id)
    {
        $sessionResult = Result::where('session_id', $id)->with('question.answers')->get();

        return view('result', compact('sessionResult'));
    }

    public function userResult($id)
    {
        $sessions = Session::where('subject_id',$id)->select('user_id','subject_id')->with('user')->get('subject_id')->groupBy('user_id');
        // $s_result = Session::where('subject_id')->select('subject_id',DB::raw('count(*) as total'));

        return view('userResult', compact('sessions'));
    }

    public function sResult($subjectId,$userId)
    {
        $sessions = Session::where('subject_id',$subjectId)->where('user_id',$userId)->get();

        return view('sResult', compact('sessions'));
    }

    public function addTests(Request $request)
    {
        $subjects = Subject::all();

        return view('addTests', compact('subjects'));

    }

    public function storeTest(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|in:Onat-ili,Tarix,Dasturlash',
            'answer[]' => 'required',
            'question'=> 'required',
            'is_true' => 'required|in:A,B,C',
        ]);
    try {
    $data = $request->all();

    $question = new Question();
    $question->subject_id = $data['subject_id'];
    $question->body = $data['question'];
  
    $question->save();

    foreach($data['answer'] as $key => $value)
    {
    $answer = new Answer();
    $answer->body = $value;

    $answer->question_id = $question->id;
    $answer->is_true =  $data['is_true'] == $key ? '1' : '0';
   
    $answer->save();
    session()->flash('message','Question has been inserted Successfully!');
    }
    }
    catch(\Exception $e){
        return view('addTests')->with('error','Something went wrong!');
    }
    return redirect()->route('addTests')->with('success', 'Data has been inserted Successfully!');
    }
}
