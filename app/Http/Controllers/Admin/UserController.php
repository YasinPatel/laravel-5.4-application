<?php

namespace App\Http\Controllers\Admin;

use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;
use Webpurify;
use App\Http\Requests;

class UserController extends Controller
{
    public function __construct()
     {
         $this->middleware('admin_auth');
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users=Users::where([
                            ['user_type','U'],
                            ['is_deleted','N'],
                          ])
                    ->orderBy('id', 'desc')
                    ->get();
      return view('admin.users.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // $state= Webpurify::seachfortext('aniket pawar');
      // $state= Webpurify::seachforimage('https://11m5ki43y82budjol1gjvv5s-wpengine.netdna-ssl.com/wp-content/uploads/2015/02/office-opening-1.jpg');
      // $state= Webpurify::seachforvideo('https://www.webpurify.com/samples/small.mp4');
      // echo "<pre>";
      // print_r($state);
      // die;

      // $destinationPath = public_path('/images');
      //
      //         echo "<pre>";
      //         print_r($destinationPath);
      //         die;

      $rules= [
            'email_id' => 'required|max:255|min:6|email|unique:user_master',
            'user_name' => 'required|max:255|min:3',
            'password' => 'required|max:255|min:6',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
               return redirect('admin/user/create')
                           ->withErrors($validator)
                           ->withInput();
        }
        $user=new Users;
        $user->user_name=$request->input('user_name');
        $user->email_id=$request->input('email_id');
        $user->password=md5($request->input('password'));

        $image = $request->file('image');
        $photoName = time().'.'.$request->image->getClientOriginalExtension();
        $destinationPath = public_path('/uploads/images');
        $user->password='/uploads/images/'.$photoName;
        $image->move($destinationPath, $photoName);

        if($user->save())
        {
          $message=config('params.msg_success').'User successfully created !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect('admin/user');
        }
        else {
          $message=config('params.msg_error').'Error in save !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect('admin/user');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user=Users::find($id);

      if($user)
      {
        return view('admin.users.view',['user'=>$user]);
      }
      else {
        $message=config('params.msg_error').'User not found !'.config('params.msg_end');

        Session::flash('message',$message);
        return redirect('admin/user');
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user=Users::find($id);
      if(!$user)
      {
        $message=config('params.msg_error').'User not found !'.config('params.msg_end');

        Session::flash('message',$message);
        return redirect('admin/user');
      }
      return view('admin.users.edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $rules= [
            'email_id' => 'required|max:255|min:6|email',
            'user_name' => 'required|max:255|min:3',
            // 'password' => 'max:255|min:6',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('admin/user/'.$id.'/edit')
                           ->withErrors($validator)
                           ->withInput();
        }
        $user=Users::find($id);
        if(!$user)
        {
          $message=config('params.msg_error').'User not found !'.config('params.msg_end');

          Session::flash('message',$message);
          return redirect('admin/user');
        }
        $user->user_name=$request->input('user_name');
        $user->email_id=$request->input('email_id');
        $user->password=md5($request->input('password'));

        if($user->save())
        {
          $message=config('params.msg_success').'User successfully updated !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect('admin/user');
        }
        else {
          $message=config('params.msg_error').'Error in update !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect('admin/user');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user=Users::find($id);
      if(!$user)
      {
        $message=config('params.msg_error').'User not found !'.config('params.msg_end');

        Session::flash('message',$message);
        return redirect('admin/user');
      }
      $user->is_deleted='Y';
      // $user->delete();
      if($user->save())
      {
        $message=config('params.msg_success').'User successfully deleted !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        return redirect('admin/user');
      }
      else {
        $message=config('params.msg_error').'Error in delete !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        return redirect('admin/user');
      }
    }

    public function anyData()
    {
      // echo "<pre>";
      // print_r($_REQUEST);
      // die;
      $query=Users::where([
                            ['user_type','U'],
                            ['is_deleted','N'],
                          ]);

      if(isset($_REQUEST['search']['value'])&& $_REQUEST['search']['value']!=null)
      {
        $query->where(function($query1){
              $query1->where('email_id','like','%'.$_REQUEST['search']['value'].'%')
                    ->orwhere('user_name','like','%'.$_REQUEST['search']['value'].'%');
        });
      }
      $recordsFiltered=$query->count();
      if(isset($_REQUEST['start']) && $_REQUEST['start']!=null &&
      isset($_REQUEST['length']) && $_REQUEST['length']!=null
      )
      {
            $query->offset($_REQUEST['start']);
            $query->limit($_REQUEST['length']);
      }
      $users=$query->orderBy('id', 'desc')->get();

      $total_records=Users::where([
                            ['user_type','U'],
                            ['is_deleted','N'],
                          ])->count();

      $arr['draw']=$_REQUEST['draw'];
      $arr['recordsTotal']=$total_records;
      $arr['recordsFiltered']=$recordsFiltered;
      $arr['data']=$users;

      // echo "<pre>";
      // print_r($arr);
      // die;
      return json_encode($arr);
    }
}
