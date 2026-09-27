@extends('layouts.pages')
	@include('users.ajax.Middleware')
@section('content')
<!-- Tabs with bottom line -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">User-Administration Panel</h6>
                </div>
                <div class="panel-body">
                    <div class="tabbable">
                        <ul class="nav nav-tabs nav-tabs-bottom bottom-divided">
                            <li class="active"><a href="#bottom-divided-tab1" data-toggle="tab">Active</a></li>
                            <li><a href="#bottom-divided-tab2" data-toggle="tab">Suspended</a></li>
                            <li><a href="#bottom-divided-tab3" data-toggle="tab">Import Users</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="bottom-divided-tab1">
                                <!-- Start Table to display active user data -->
                                <div class="panel panel-flat">

                                    <table class="table table-striped datatable-pagination table-sm">
                                        <thead>
                                            <tr>
                                                <th>First-Name</th>
                                                <th>Middle-Name</th>
                                                <th>Last-Name</th>
                                                <th>Email</th>
                                                <th>Created At</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $sn = 1;
                                            @endphp
                                            @foreach($alumnis As $alumni)
                                            <tr>
                                                <td>{{$alumni->first_name}}</td>
                                                <td>{{$alumni->middle_name}}</td>
                                                <td>{{$alumni->last_name}}</td>
                                                <td>{{$alumni->email}}</td>
                                                <td>{{$alumni->created_at}}</td>
                                                <td class="text-center">
                                                    <ul class="icons-list">
                                                        <li class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-right">
                                                                <li><a href="#" id="suspend_alumni_account" data-trashid="{{$alumni->userId}}"><i class="icon-blocked"></i>Suspend</a></li>
                                                                <li><a href="#" id="change_account_password" data-passid="{{$alumni->userId}}" data-toggle="modal" data-target="#modal_form_change_password"><i class="icon-file-locked"></i>Password</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    </div>
                                    <!-- End Table to display active user data -->
                                
                            </div>

                            <div class="tab-pane" id="bottom-divided-tab2">
                              <!-- Start Table to display trashed user data -->
                             <div class="panel panel-flat">
                                    <table class="table datatable-pagination table-sm">
                                        <thead>
                                            <tr>
                                                <th>First-Name</th>
                                                <th>Middle-Name</th>
                                                <th>Last-Name</th>
                                                <th>Email</th>
                                                <th>Created At</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $sn = 1;
                                            @endphp
                                            @foreach($trashed_alumnis As $trashed_alumni)
                                            <tr>
                                                <td>{{$trashed_alumni->first_name}}</td>
                                                <td>{{$trashed_alumni->middle_name}}</td>
                                                <td>{{$trashed_alumni->last_name}}</td>
                                                <td>{{$trashed_alumni->email}}</td>
                                                <td>{{$trashed_alumni->created_at}}</td>
                                                <td class="text-center">
                                                    <ul class="icons-list">
                                                        <li class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-right">
                                                                <li><a href="#" id="activate_alumni_account" data-restoreid="{{$trashed_alumni->userId}}"><i class="icon-blocked"></i>Activate</a></li>
                                                                <li><a href="#" id="delete_alumni_account" data-deleteid="{{$trashed_alumni->userId}}"><i class="icon-file-locked"></i>Delete</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    </div>
                                    <!-- End Table to display active user data -->
                            </div>

                            <div class="tab-pane" id="bottom-divided-tab3">
                              <!-- Start Table to display trashed user data -->
                             <div class="panel panel-flat">
                                <form action="{{ route('users-import') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                        <div class="panel panel-flat">

                                            <div class="panel-body">
                                                <div class="row">
                                                    
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Upload Bulk Users:</label>
                                                            <input type="file" name="file" class="file-styled">
                                                            <span class="help-block">Accepted formats: csv/excel. Max file size 2Mb. <a href="{{route('users-export')}}" class="fa fa-download">Download Template</a></span>
                                                        </div> 
                                                    </div>
                                                </div>

                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-primary">Add-User <i class="icon-arrow-right14 position-right"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                    <!-- End Table to display active user data -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <!-- /tabs with bottom line -->

    <!-- Start popup form to change password-->
	<div id="modal_form_change_password" class="modal fade">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="background-color:info">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title">Reset Account Password</h5>
				</div>
			<!-- Start Insert show form here-->
            {!! Form::open(['route' => ['Update-Alumni-Password'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="panel panel-flat">
                    <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                    <input type="hidden" name="user_id" id="id_change_password" value="">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>New Password:</label>
                                    <input type="password" name="New_Password" id="new_password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary" id="Reset_Password">Reset-Password <i class="icon-arrow-right14 position-right"></i></button>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>
            {!! Form::close() !!}
			<!-- End Insert show form here-->
			</div>
		</div>
	</div>
    <!-- End popup form to change password-->
@endsection