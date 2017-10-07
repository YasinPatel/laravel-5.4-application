@extends('admin.layouts.main')


@section('main_contant')
<section class="content-header">
  <h1>
      User Details
  </h1>
  <ol class="breadcrumb">
    <li ><a href="{{ route('admin_home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li ><a href="{{ URL::to('admin/user') }}">Users</a></li>
    <li class="active">User Details</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="box box-default">
        <div class="box-header with-border">
          <!-- <a href="{{ URL::to('admin/user/create') }}" class="btn btn-primary pull-right">Delete</a> -->
          <a href="{{ URL::to('admin/user/'.$user->id.'/edit') }}" class="btn btn-primary pull-right">Edit</a>
        </div>
        <div class="box-body">

          <table class="table table-bordered">
            <tbody>
              <tr>
                <th style="width:10%">Name</th>
                <td>{{$user->user_name}}</td>
              </tr>
              <tr>
                <th style="width:10%">Email</th>
                <td>{{$user->email_id}}</td>
              </tr>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
</section>
@endsection
