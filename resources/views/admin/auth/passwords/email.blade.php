@extends('admin.layouts.login')

@section('main_contant')
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-6 col-md-offset-3">
            <div class="panel panel-default"  style="margin-top:15%">
                <div class="panel-heading">

                  <h3 style="margin: 5px 0px;">Forgot Password</h3>
                </div>
                <div class="panel-body">
                  @if (Session::has('message'))
                    {!! Session::get('message') !!}
                  @endif

                  {!! Form::open(['url' => 'admin/password/email','method'=>'POST','class'=>'form-horizontal']) !!}
                    <div class="form-group">
                      <label for="email_id" class="col-sm-3 control-label">Email Id</label>
                      <div class="col-sm-8">
                        {{ Form::text('email_id',null,['class'=>'form-control','id'=>'email_id','placeholder'=>'Email id']) }}
                        @if ($errors->first('email_id'))
                          <span for="email_id" class="help-block">{{ $errors->first('email_id') }}</span>
                        @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </div>
                  {!! Form::close() !!}
                </div>
                <div class="panel-footer">
                  <div class="row">
                    <div class="col-sm-12">

                  <p class="pull-left">
                    <a href="{{ URL::to('admin/login') }}">Sign In</a>

                  </p>
                  <p class="pull-right">
                    Sign in with
                     <a href="{{ route('facebook_login') }}">Facebook</a> or
                     <a href="{{ route('google_login') }}">Google</a>
                  </p>
                </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
