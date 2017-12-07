<?php

namespace App\Http\Controllers;

use App\Topic;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::all();
        $res = [
            "status" => "success",
            "topics" => $topics
        ];
        return response()->json($res);
    }
}
