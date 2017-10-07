<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use Session;
use App\Http\Requests;
use App\Models\Admin;
use App\Models\Users;
use Socialite;

class DefaultController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_auth')->only('index','logout');
        $this->middleware('admin_guest')->only('showLoginForm','login','redirectToGoogle','redirectToFacebook');
    }
    public function index()
    {
      return view('admin.home.index');
    }
    public function showLoginForm()
    {
      return view('admin.auth.login');
    }
    public function login(Request $request)
    {
      $rules= [
            'email_id' => 'required|email',
            'password' => 'required',
        ];
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
             return redirect('admin/login')
                         ->withErrors($validator)
                         ->withInput();
      }

      $user=Admin::where('email_id',$request->input('email_id'))->where('user_type','A')->where('is_deleted','N')->first();

      if($user) // user exist
      {
        if($user->is_active=='N') // check user is blocked or not
        {
          $message=config('params.msg_error').'You have been blocked by admin  !'.config('params.msg_end');
          Session::flash('message',$message);
          return redirect('admin/login');
        }
        if($user->password!=md5($request->input('password')))
        {
          $message=config('params.msg_error').'Email id or password does not match  !'.config('params.msg_end');
          Session::flash('message',$message);
          return redirect('admin/login');
        }

        Auth::guard('admin')->login($user);

        return redirect('admin');

      }
      else { // user not found
        $message=config('params.msg_error').'Email Id not found !'.config('params.msg_end');
        Session::flash('message',$message);

        return redirect('admin/login');
      }
    }
    public function logout()
    {
      // $this->admin_auth->logout();
      Auth::guard('admin')->logout();
      return redirect('admin/login');
    }

    //facebook login
    public function redirectToFacebook()
    {
      try {
        return Socialite::driver('facebook')->scopes(['email'])->redirect();
      } catch (Exception $e) {
        return redirect('admin/login');
      }
    }

    //facebook redirect
    public function handleFacebookCallback()
    {
      try {
        $user = Socialite::driver('facebook')->user();
        // $user = Socialite::driver('facebook')->userFromToken($token);  get user from token

        if(isset($user->email) && $user->email!=null)
        {
          // check token exist or not
          $model=Users::where('facebook_token',$user->token)->where('is_deleted','N')->first();

          if(isset($model) && $model!=null)
          {
            Auth::guard('admin')->login($user);
            return redirect('admin');
          }
          // check email exist or not
          $model=Users::where('email_id',$user->email)->where('is_deleted','N')->first();

          if(isset($model) && $model!=null)
          {
            $message=config('params.msg_error').'Email Id already registered !'.config('params.msg_end');
            Session::flash('message',$message);
            return redirect('admin/login');
          }

          $model=new Admin;
          $model->email_id=$user->email;
          $model->facebook_token=$user->token;
          if(isset($user->name) && $user->name!=null)
          {
            $model->user_name=$user->name;
          }
          if(isset($user->avatar) && $user->avatar!=null)
          {
            $model->image_url=$user->avatar;
          }
          if($model->save())
          {
            Auth::guard('admin')->login($model);
            return redirect('admin');
          }
          else {
            $message=config('params.msg_error').'Error in save !'.config('params.msg_end');
            $request->session()->flash('message',$message);
            return redirect('admin/login');
          }
        }
        else {
          $message=config('params.msg_error').'Email Id not found !'.config('params.msg_end');
          Session::flash('message',$message);
          return redirect('admin/login');
        }
      }
      catch (Exception $e) {
        return redirect('admin/login');
      }
    }

    //google login
    public function redirectToGoogle()
    {
      try {
        return Socialite::driver('google')->scopes(['email'])->redirect();
      } catch (Exception $e) {
        return redirect('admin/login');
      }

    }

    //google redirect
    public function handleGoogleCallback()
    {
      try {
        $user = Socialite::driver('google')->user();
        // $user = Socialite::driver('facebook')->userFromToken($token);  get user from token
        if(isset($user->email) && $user->email!=null)
        {
          // check token exist or not
          $model=Users::where('google_token',$user->token)->where('is_deleted','N')->first();

          if(isset($model) && $model!=null)
          {
            Auth::guard('admin')->login($user);
            return redirect('admin');
          }
          // check email exist or not
          $model=Users::where('email_id',$user->email)->where('is_deleted','N')->first();

          if(isset($model) && $model!=null)
          {
            $message=config('params.msg_error').'Email Id already registered !'.config('params.msg_end');
            Session::flash('message',$message);
            return redirect('admin/login');
          }
          $model=new Admin;
          $model->email_id=$user->email;
          $model->google_token=$user->token;
          if(isset($user->name) && $user->name!=null)
          {
            $model->user_name=$user->name;
          }
          if(isset($user->avatar_original) && $user->avatar_original!=null)
          {
            $model->image_url=$user->avatar_original;
          }
          if($model->save())
          {
            Auth::guard('admin')->login($model);
            return redirect('admin');
          }
          else {
            $message=config('params.msg_error').'Error in save !'.config('params.msg_end');
            $request->session()->flash('message',$message);
            return redirect('admin/login');
          }
        }
        else {
          $message=config('params.msg_error').'Email Id not found !'.config('params.msg_end');
          Session::flash('message',$message);
          return redirect('admin/login');
        }
      }
      catch (Exception $e) {
        return redirect('admin/login');
      }
    }
}
