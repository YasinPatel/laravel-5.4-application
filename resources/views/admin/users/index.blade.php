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
          <table class="table table-bordered" id="users-table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email Id</th>
                <th>Actions</th>
              </tr>
            </thead>
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

<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        "bLengthChange": true,
        "info": false,
        // "pageLength": 1,
        ajax:'{!! route("getuserdata") !!}',
        columns: [
            { data: 'user_name', name: 'user_name' },
            { data: 'email_id', name: 'email_id' },
            { data:null,
              render: function (o) {
                return '<a class="btn btn-default btn-sm" href="user/'+o.id+'/edit"><i class="fa fa-pencil"></i></a>'+
                '<a href="user/'+o.id+'" class="btn btn-default pull-left btn-sm" style="margin:0 10px"><i class="fa fa-eye"></i></a>';
               }
            }

        ]
    });
});
</script>
@endsection
