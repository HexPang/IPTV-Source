<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Program;

class ChannelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        //
    }

    public function GetChannel($hash){
        $channels = Channel::where('pid',$hash)->get();
        $program = Program::find($hash);
        if($program){
            $program->views++;
            $program->save();
        }
        $content = "#EXTM3U\r\n";
        foreach($channels as $channel){
            $content .= "#EXTINF:-1,{$channel->name}\r\n{$channel->url}\r\n";
        }
        return response($content, 200)
            ->header('Content-Type', "Application/m3u");
    }

    public function GetChannelViaHTML($hash){
        $program = Program::find($hash);
        if($program){
            $program->views++;
            $program->save();
        }
        $channels = Channel::where('pid',$hash)->get();
        return view('list',['channels' => $channels]);
    }
}
