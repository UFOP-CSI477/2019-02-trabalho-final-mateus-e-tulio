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
        //
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
        if ($i_hired) {
            $feedback->hirers_score = $request->grade;
            $feedback->message_for_hirer = $request->message;
        } else {
            $feedback->hireds_score = $request->grade;
            $feedback->message_for_hired = $request->message;
        }
        $feedback->save();

        $post = Post::findOrFail($id);
        $post->status = 'Concluído';
        $post->save();

        $answer = Answer::where('posts_id', $id)->where('users_id', $user)->first();
        $answer->solved = 'Sim';
        $answer->save();
        
        Session::flash('message', 'Avaliação feita com sucesso!'); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('publish');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        //
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
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
