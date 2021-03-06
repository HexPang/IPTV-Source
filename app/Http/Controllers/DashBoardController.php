<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Program;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class DashBoardController extends Controller
{
    protected $guard = 'web';
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function ShowIndex(Request $request){
        $user = $request->user;
//        $programs = Program::where('uid',$request->user->id)->take(10)->get();
        return view('dashboard.index',['programs' => [],'user'=>$user]);
    }

    public function API_POST(Request $request,$action){
        if($action == 'programs' && $request->get('name')) {
            $name = $request->get('name');
//            dd($request->getUser());
            $id = $request->get('id', 0);
            $program = Program::where('uid', $request->user->id)->where('name', $name)->first();
            if ($program && $id == 0) {
                return 0;
            } else if($id > 0){
                $program = Program::where('id', $id)->where('uid', $request->user->id)->first();
                $program->name = $name;
                $program->save();
                return $program;
            }
            return Program::create(['name' => $request->get('name'), 'uid' => $request->user->id]);
        }else if($action == 'channels' && $request->get('name') && $request->get('url') && $request->get('pid')) {
            $id = intval($request->get('id', 0));
            if ($id > 0) {
                $channel = Channel::where('id', $id)->where('pid', $request->get('pid'))->where('uid', $request->user->id)->first();
                if ($channel) {
                    $channel->name = $request->get('name');
                    $channel->url = $request->get('url');
                    $channel->pid = $request->get('pid');
                    $channel->save();
                    return $channel;
                } else {
                    return 0;
                }
            } else {
                return Channel::create([
                    'name' => $request->get('name'),
                    'url' => $request->get('url'),
                    'pid' => $request->get('pid'),
                    'uid' => $request->user->id
                ]);
            }
        }else if($action == 'remove' && $request->get('id')) {
            $channel = Channel::where('id', $request->get('id'))->where('uid', $request->user->id)->first();
            if ($channel) {
                $channel->delete();
                return 1;
            } else {
                return 0;
            }
        }else if($action == 'share' && $request->get('id')){
            $id = $request->get('id',0);
            $program = Program::find($id);
            if($program){
                if($request->get('share') == 'true'){
                    $program->hash = str_random(5);
                }else{
                    $program->hash = '';
                }
                $program->save();
                return $program;
            }
            return 0;
        }else{
            return ['error' => 'UNKNOW_ACTION'];
        }
    }

    public function API(Request $request,$action){
        if($action == 'programs') {
            $programs = Program::where('uid', $request->user->id)->get();
            foreach($programs as $k=>$v){
                $programs[$k]['channels'] = Channel::where('pid',$v->id)->get();
            }
            return $programs;
        }else if($action == 'channels' && $request->get('pid')) {
            $channels = Channel::where('pid', $request->get('pid'))->get();
            return $channels;
        }else if($action == 'verify' && $request->get('id')){
            $channel = Channel::find($request->get('id'));
            if($channel){
                return $this->page_exists($channel->url);
            }
        }else{
            return ['error' => 'UNKNOW_ACTION'];
        }
    }

    public function ShowLogin(){
        return view('dashboard.login');
    }

    public function ShowSignUp(Request $request){
        if($request->method() == 'POST'){
            $validator = Validator::make($request->all(), [
                'email'    => 'required|email',
                'name'     => 'required',
                'password' => 'required',
            ]);
            $msg = "";
            $user = null;
            if ($validator->fails()) {
                $msg = "信息不完整.";
            }else{
                $user = User::where('email',$request->get('email'))->first();
                if($user){
                    $msg = "邮箱已存在.";
                    $user = null;
                }else{
                    $user = User::where('name',$request->get('name'))->first();
                    if($user){
                        $msg = '昵称已存在';
                        $user = null;
                    }else{
                        $user = User::create([
                            'name' => $request->get('name'),
                            'email' => $request->get('email'),
                            'password' => app('hash')->make($request->get('password'))
                        ]);
                        if(!$user){
                            $msg = "注册失败.";
                            $user = null;
                        }else{
                            $msg = "注册成功.";
                        }
                    }
                }
            }
            return view('dashboard.signup',['msg'=>$msg,'user'=>$user]);
        }else{
            return view('dashboard.signup',['user'=>null]);
        }

    }

    public function PostLogin(Request $request){
        $errMsg = "";

        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $errMsg = "账号或密码无效.";
        }else{
            $credentials = $request->only('email', 'password');
            $user = User::where('email',$credentials['email'])->first();
            if($user && Hash::check($credentials['password'],$user->password)){
                $user->token = str_random(32);
                $user->save();
                return redirect('/dashboard/',302,[
                    'Set-Cookie' => 'token=' . $user->token
                ]);
            }else{
                $errMsg = '账号或密码错误.';
            }
        }

        return view('dashboard.login',['msg'=>$errMsg]);
    }
}
