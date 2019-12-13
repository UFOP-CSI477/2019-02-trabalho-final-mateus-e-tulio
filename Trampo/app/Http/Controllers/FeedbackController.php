<?php

namespace App\Http\Controllers;
use App\Post;
use App\Answer;
use App\Feedback;
use Illuminate\Http\Request;
use Session;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedbacks = Feedback::join('posts', 'feedback.posts_id', 'posts.id')
            ->where(function ($query) {
                $query->where('posts.hirer_id', auth()->user()->id)
                    ->whereNull('feedback.hireds_score');
            })->orWhere(function ($query) {
                $query->where('posts.hired_id', auth()->user()->id)
                    ->whereNull('feedback.hirers_score');
            });

        $feedbacks_r = Feedback::join('posts', 'feedback.posts_id', 'posts.id')
            ->where(function ($query) {
                $query->where('posts.hirer_id', auth()->user()->id)
                    ->whereNotNull('feedback.hireds_score');
            })->orWhere(function ($query) {
                $query->where('posts.hired_id', auth()->user()->id)
                    ->whereNotNull('feedback.hirers_score');
            });
        
        return view('feedbacks.index', ['feedbacks_r' => $feedbacks_r->get(), 'feedbacks' => $feedbacks->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $i_hired, $id, $user)
    {
        $feedback = new Feedback;
        $feedback->posts_id = $id;

        $post = Post::findOrFail($id);
        $post->status = 'Concluído';

        
        if ($i_hired == '1') {
            $feedback->hireds_score = $request->grade;
            $feedback->message_for_hired = $request->message;
            $post->hired_id = $user;
        } else {
            $feedback->hirers_score = $request->grade;
            $feedback->message_for_hirer = $request->message;
            $post->hirer_id = $user;
        }

        $feedback->save();
        $post->save();
        
        Session::flash('message', 'Avaliação feita com sucesso!'); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('profile');
    }

    public function show($id)
    {
        $feedback = Feedback::select('posts.id AS id', 'posts.hirer_id AS hirer_id', 'hirer.name AS hirer', 'hired.name AS hired', 'posts.title AS title')
            ->join('posts', 'feedback.posts_id', 'posts.id')
            ->join('users AS hirer', 'posts.hirer_id', 'hirer.id')
            ->join('users AS hired', 'posts.hired_id', 'hired.id')
            ->where('posts.id', $id)
            ->where(function ($query) {
                $query->where('posts.hirer_id', auth()->user()->id)
                ->orWhere('posts.hired_id', auth()->user()->id);
            })->first();

            
        $i_hired = $feedback->hirer_id == auth()->user()->id;

        return view('feedbacks.show', ['feedback' => $feedback, 'i_hired' => $i_hired]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    public function update(Request $request, $i_hired, $id)
    {
        $feedback = Feedback::findOrFail($id);
        if ($i_hired==1) {
            $feedback->hireds_score = $request->grade;
            $feedback->message_for_hired = $request->message;
        } else {
            $feedback->hirers_score = $request->grade;
            $feedback->message_for_hirer = $request->message;
        }

        $feedback->save();
        
        Session::flash('message', 'Avaliação feita com sucesso!'); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        //
    }
}
