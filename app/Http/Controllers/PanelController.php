<?php

namespace App\Http\Controllers;

use App\Mail\sendcodemail;
use App\Models\Code;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PanelController extends Controller
{
    public function loginwriter()
    {
        return view('loginwriter.loginwriter');
    }

    public function logincreate(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required'
        ]);
        User::create([
          'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        return redirect('logincheck');
    }

    public function logincheck()
    {
        return view('logincheck.logincheck');
    }

    public function logincheckpost(Request $request)
    {
       $user=User::where('email',$request->email)->first();

        $code=rand(10000,99999);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password] )&& $user){
            $user->code()->delete();
            $user->code()->create([
                'code'=>$code,
                'expired_at'=>Carbon::now()->addSeconds(1),
            ]);
           $data=[
               'title'=>'bbmbm',
               'code'=>$code,

           ];
           Mail::to($user)->send(new sendcodemail($data));
           return redirect('checkcode');
        }else{
            return  back();
        }
    }

    public function checkcode()
    {
       return view('checkcode.checkcode');
    }


    public function checkcodepost(Request $request)
    {

        $codecheck = Code::where('code', $request->code)->first();
        if($codecheck){
            return redirect('panel');
        }
    }

    public function panel()
    {
        $r=Post::where('user_id',auth()->id())->get();


        return view('panel.panel',['r'=>$r]);
    }

    public function logoutpanel()
    {
        auth()->logout();
        return redirect('logincheck');
    }

    public function updatepanelpassword(Request $request ,$id)
    {
        $updatepanel=User::find($id);
        $updatepanel->email=$request->email;
        $updatepanel->password=$request->password;
        $updatepanel->name=Hash::make($request->name);
        $updatepanel->update();
        return back();
    }

    public function postspanel(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'text'=>'required',
            'file'=>'required',
        ]);
       $file=$request->file('file');
       $name=time().$file->getClientOriginalName();
       $file->move('iamge',$name);
       $request->user()->posts()->create([
            'name' => $request->name,
            'text' => $request->text,
            'file' => $name,
        ]);
      return back();

    }

    public function deletepostpanel($id)
    {
        $deltepostpanel=Post::find($id);
        $deltepostpanel->delete();
        return back();
    }

    public function updateposts()
    {
        return view('updatepost.updatepost');
    }

    public function updatepostsput( Request $request ,$id)
    {
        $file=$request->file('file');
        $name=time().$file->getClientOriginalName();
        $file->move('iamge',$name);
      $request->user()->posts($id)->update([
          'name' => $request->name,
          'text' => $request->text,
          'file' => $name,
      ]);
      return redirect('panel');
    }


}
