<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;

class TweetController extends Controller
{
    public function index(){
        $tweets = Tweet::all();
        return view('tweets.index',[
            'tweets' => $tweets
        ]);
    }

    public function create(){
        return view('tweets.create');
    }

    public function store(Request $request){
        $tweet = new Tweet;
        $tweet->body = $request->input('body');
        $tweet->save();

        return redirect('/tweets');
    }

    public function show($id){
        $tweet = Tweet::find($id);
        return view('tweets.show',[
            'tweet' => $tweet
        ]);
    }

    public function edit($id){
        $tweet = Tweet::find($id);
        return view('tweets.edit',[
            'tweet' => $tweet
        ]);
    }

    public function update(Request $request, $id){
        $tweet = Tweet::find($id);
        $tweet->body = $request->input('body');
        $tweet->save();
        return redirect('/tweets'); 
    }

    public function destroy($id){
        $tweet = Tweet::find($id);
        $tweet->delete($id);

        return redirect('/tweets');

    }


}
