@extends('admin.layouts.main')


@section('main_contant')
<section class="content-header">
  <h1>
      Update User
  </h1>
  <ol class="breadcrumb">
    <li ><a href="{{ route('admin_home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li ><a href="{{ URL::to('admin/user') }}">Users</a></li>
    <li class="active">Update User</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="box box-default">
        <div class="box-body">
          {{ Form::model($user,['route'=>['user.update', $user->id],'method' => 'PUT','class'=>'form-horizontal'])}}

          <div class="form-group">
            <label for="user_name" class="col-sm-2 control-label">User Name</label>
            <div class="col-sm-8">
              {{ Form::text('user_name',null,['class'=>'form-control','id'=>'user_name']) }}
              @if ($errors->first('user_name'))
                <span for="user_name" class="help-block">{{ $errors->first('user_name') }}</span>
              @endif
            </div>
          </div>

          <div class="form-group">
            <label for="email_id" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-8">
              {{ Form::text('email_id',null,['class'=>'form-control','id'=>'email_id']) }}
              @if ($errors->first('email_id'))
                <span for="email_id" class="help-block">{{ $errors->first('email_id') }}</span>
              @endif
            </div>
          </div>

          <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-8">
              {{ Form::password('password',['class'=>'form-control','id'=>'password']) }}
              @if ($errors->first('password'))
                <span for="password" class="help-block">{{ $errors->first('password') }}</span>
              @endif
            </div>
          </div>

        </div>
        <div class="box-footer">
          <div class="form-group">
            <div class="col-sm-offset-2">
              <button type="submin" class="btn btn-primary" name="button">Update</button>
              <a class="btn btn-default" href="{{ URL::to('admin/user')}}">Cancel</a>

            </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
