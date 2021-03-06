<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Program;
use App\User;

class ChannelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {

    }
    public function GetIndex(){
        $programs = Program::where('hash','<>','')->take(30)->get();
        foreach($programs as $k=>$v){
            $user = User::find($v->uid);
            $channels = Channel::where('pid',$v->id)->get();
            $programs[$k]['user'] = $user;
            $programs[$k]['count'] = count($channels);
        }
        return view('index',['programs'=>$programs]);
    }
    public function GetChannel($hash){
        $program = Program::where('hash',$hash)->first();
        if($program){
            $channels = Channel::where('pid',$program->id)->get();
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

    }

    public function GetChannelViaHTML($hash){
        $program = Program::where('hash',$hash)->first();
        if($program){
            $program->views++;
            $program->save();
        }
        $channels = Channel::where('pid',$program->id)->get();
        return view('list',['channels' => $channels]);
    }
}
