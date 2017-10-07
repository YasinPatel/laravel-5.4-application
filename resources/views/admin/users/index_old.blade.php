@extends('admin.layouts.main')


@section('main_contant')
<section class="content-header">
  <h1>
    Users
  </h1>
  <ol class="breadcrumb">
    <li ><a href="{{ route('admin_home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li ><a href="{{ URL::to('admin/user') }}">Users</a></li>
    <li class="active">List</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-sm-12">
      @if (Session::has('message'))
        {!! Session::get('message') !!}
      @endif
      <div class="box box-default">
        <div class="box-header with-border">
          <a href="{{ URL::to('admin/user/create') }}" class="btn btn-primary pull-right">Add User</a>
        </div>
        <div class="box-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email Id</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @if(count($users)>0)
                @foreach($users as $user)
                  <tr>
                    <td>{{ $user->user_name}}</td>
                    <td>{{ $user->email_id}}</td>
                    <td>
                      <a href="{{ URL::to('admin/user/'.$user->id.'/edit') }}" class="btn btn-default pull-left btn-sm"><i class="fa fa-pencil"></i></a>
                      &nbsp;&nbsp;
                      <a href="{{ URL::to('admin/user/'.$user->id) }}" class="btn btn-default pull-left btn-sm" style="margin:0 10px"><i class="fa fa-eye"></i></a>

                      {{ Form::open(array('url' => 'admin/user/' . $user->id,'class'=>'pull-left')) }}
                       {{ Form::hidden('_method', 'DELETE') }}
                       <button type="submit" class="btn btn-danger btn-sm btn-submit" ><i class="fa fa-trash-o"></i></button>
                      {{ Form::close() }}
                    </td>
                  </tr>
                @endforeach
                @else
                  <tr>
                    <td>
                      No Result found
                    </td>
                  </tr>
                @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('custom_scripts')
<script type="text/javascript">
$(".btn-submit").click(function(){
  a=confirm('Are you sure to delete record ?')
  if(!a)
  {
    return false;
  }
});
</script>
@endsection
