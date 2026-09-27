@extends('layouts.pages')
	@include('Interested_Area.ajax.Middleware')
@section('content')
<!-- Tabs with bottom line -->
<div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Interested Areas Panel</h6>
                </div>
                <div class="panel-body">
                    <div class="tabbable">
                        <ul class="nav nav-tabs nav-tabs-bottom bottom-divided">
                            <li class="active"><a href="#bottom-divided-tab1" data-toggle="tab"><i class="icon-file-eye"></i> View</a></li>
                            <li><a href="#bottom-divided-tab2" data-toggle="tab"><i class="icon-rotate-ccw3"></i> Restore</a></li>
                            <li><a href="#bottom-divided-tab3" data-toggle="tab"><i class="icon-file-plus"></i> Add</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="bottom-divided-tab1">
                            @if(session()->has('bulk_success_message'))
								<div class="alert alert-primary no-border">
									<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
									<span class="text-semibold">Dear User!</span> {{ session()->get('bulk_success_message') }} <a href="#" class="alert-link">. See you again</a> and wish you a nice day.
								 </div>
							@endif
                                <!-- Start Table to display active user data -->
                                <div class="panel panel-flat">

                                    <table class="table table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Interested-Area</th>
                                                <th>Created-At</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $sn = 1;?>
                                            @foreach ($interested_areas as $area)
                                            <tr>
                                                <td><i class="icon-checkmark4"></i> {{ $area->expertise }}</td> <!-- Replace 'column4' with the actual column name -->
                                                <td>{{ $area->created_at }}</td> <!-- Replace 'column5' with the actual column name -->
                                                <td class="text-center">
                                                    <ul class="icons-list">
                                                        <li class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-right">
                                                                <li><a href="#" id="edit_interested_area" data-id="{{ $area->id }}" data-expertise="{{ $area->expertise }}" data-toggle="modal" data-target="#modal_form_interested_area"><i class="fa fa-pencil-square"></i>Edit</a></li>
                                                                <li><a href="#" id="trash_interested_area" data-trashid="{{ $area->id }}"><i class="fa fa-trash"></i>Trash</a></li>
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
                                    <table class="table table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Interested-Area</th>
                                                    <th>Deleted-At</th>
                                                    <th class="text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $sn = 1;?>
                                                @foreach ($deleted_interested_areas as $area)
                                                <tr>
                                                    <td><i class="icon-cross2"></i> {{ $area->expertise }}</td> <!-- Replace 'column4' with the actual column name -->
                                                    <td>{{ $area->deleted_at }}</td> <!-- Replace 'column5' with the actual column name -->
                                                    <td class="text-center">
                                                        <ul class="icons-list">
                                                            <li class="dropdown">
                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                    <i class="icon-menu9"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-right">
                                                                    <li><a href="#" id="undo_interested_area" data-restoreid="{{ $area->id }}"><i class="icon-rotate-ccw2"></i>Undo</a></li>
                                                                    <li><a href="#" id="delete_interested_area" data-deleteid="{{ $area->id }}"><i class="icon-trash"></i>Delete</a></li>
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
                                <!-- Start Personal Skill Form -->
                                {!! Form::open(['route' => 'Create-Interested_Area', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'Create-Interested_Area']) !!}
                                    <!-- <form action="#" id="user_form"> -->
                                        <div class="panel panel-flat">
										<input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Interested-Area:</label>
                                                            <input type="text" name="Interested_Area" id="Interested_Area" class="form-control" placeholder="Interested Area" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="text-right">
                                                                <button type="submit" class="btn btn-primary" id="Add_Expertise">Add-Expertise <i class="icon-arrow-right14 position-right"></i></button>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </div>
											
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                    <!-- End Personal Skill Form -->
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <!-- /tabs with bottom line -->
	
<!-- Start popup form editing user-->
	<div id="modal_form_interested_area" class="modal fade">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="background-color:info">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title">Edit Interested Area</h5>
				</div>
			<!-- Start Insert show form here-->
            {!! Form::open(['route' => ['Update-Interested_Area'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="panel panel-flat">
                    <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                    <input type="hidden" name="user_id" id="id_expertise" value="">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Interested Area:</label>
                                    <input type="text" name="Interested_Area" id="interested_area" class="form-control">
                                </div>
                                <div class="form-group">
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary" id="Edit_Interested_Area">Edit-Expertise <i class="icon-arrow-right14 position-right"></i></button>
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
<!-- End popup form editing user-->
@endsection