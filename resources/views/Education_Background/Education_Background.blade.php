@extends('layouts.pages')
	@include('Education_Background.ajax.Middleware')
@section('content')
<!-- Tabs with bottom line -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Education Background Panel</h6>
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

                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Sn</th>
                                                <th>Start-Year</th>
                                                <th>End-Year</th>
                                                <th>Qualification</th>
                                                <th>Created At</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $sn = 1;?>
                                            @foreach ($education_backgrounds as $background)
                                            <tr>
                                                <td>{{  $sn++ }}</td> <!-- Replace 'column1' with the actual column name -->
                                                <td>{{ $background->start_year }}</td> <!-- Replace 'column2' with the actual column name -->
                                                <td>{{ $background->end_year }}</td> <!-- Replace 'column3' with the actual column name -->
                                                <td>{{ $background->qualification }}</td> <!-- Replace 'column4' with the actual column name -->
                                                <td>{{ $background->created_at }}</td> <!-- Replace 'column5' with the actual column name -->
                                                <td class="text-center">
                                                    <ul class="icons-list">
                                                        <li class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-right">
                                                                <li><a href="#" id="edit_education_background" data-id="{{ $background->id }}" data-startyear="{{ $background->start_year }}" data-endyear="{{ $background->end_year }}" data-qualification="{{ $background->qualification }}" data-toggle="modal" data-target="#modal_form_editing"><i class="fa fa-pencil-square"></i>Edit</a></li>
                                                                <li><a href="#" id="trash_education_background" data-trashid="{{ $background->id }}"><i class="fa fa-trash"></i>Trash</a></li>
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
                                    <table class="table table-bordered table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Sn</th>
                                                    <th>Start-Year</th>
                                                    <th>End-Year</th>
                                                    <th>Qualification</th>
                                                    <th>Deleted-At</th>
                                                    <th class="text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $sn = 1;?>
                                                @foreach ($deleted_education_backgrounds as $background)
                                                <tr>
                                                    <td>{{  $sn++ }}</td> <!-- Replace 'column1' with the actual column name -->
                                                    <td>{{ $background->start_year }}</td> <!-- Replace 'column2' with the actual column name -->
                                                    <td>{{ $background->end_year }}</td> <!-- Replace 'column3' with the actual column name -->
                                                    <td>{{ $background->qualification }}</td> <!-- Replace 'column4' with the actual column name -->
                                                    <td>{{ $background->deleted_at }}</td> <!-- Replace 'column5' with the actual column name -->
                                                    <td class="text-center">
                                                        <ul class="icons-list">
                                                            <li class="dropdown">
                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                    <i class="icon-menu9"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-right">
                                                                    <li><a href="#" id="undo_education_background" data-restoreid="{{ $background->id }}"><i class="icon-rotate-ccw2"></i>Undo</a></li>
                                                                    <li><a href="#" id="delete_education_background" data-deleteid="{{ $background->id }}"><i class="icon-trash"></i>Delete</a></li>
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
                                <!-- Start Add User Form -->
                                {!! Form::open(['route' => 'Create-Education-Background', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'Create_Education_Background']) !!}
                                    <!-- <form action="#" id="user_form"> -->
                                        <div class="panel panel-flat">
										<input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Start-Year:</label>
                                                            <select name="Start_Year" id="Start_Year" class="form-control">
                                                                <option value="">Select Year</option>
                                                                <?php
                                                                $currentYear = date('Y');
                                                                for ($i = $currentYear; $i >= $currentYear - 25; $i--) {
                                                                    echo "<option value=\"$i\">$i</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Qualification:</label>
                                                            <input type="year" name="Education_Qualification" id="Education_Qualification" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>End-Year:</label>
                                                            <select name="End_Year" id="End_Year" class="form-control">
                                                                <option value="">Select Year</option>
                                                                <?php
                                                                $currentYear = date('Y');
                                                                for ($i = $currentYear; $i >= $currentYear - 25; $i--) {
                                                                    echo "<option value=\"$i\">$i</option>";
                                                                }
                                                                ?>
                                                            </select>                                                        </div>
                                                        <div class="form-group">
                                                            <div class="text-right">
                                                                <button type="submit" class="btn btn-primary" id="Add_Qualification">Add-Qualification <i class="icon-arrow-right14 position-right"></i></button>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </div>
											
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                    <!-- End Add User Form -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <!-- /tabs with bottom line -->
	
<!-- Start popup form editing user-->
	<div id="modal_form_editing" class="modal fade">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="background-color:info">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title">Horizontal form</h5>
				</div>
			<!-- Start Insert show form here-->
            {!! Form::open(['route' => ['Update-Education-Background'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="panel panel-flat">
                    <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                    <input type="hidden" name="user_id" id="id_education" value="">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Start-Year:</label>
                                    <select name="Start_Year" id="start_year_education" class="form-control" required>
                                        <option value="">Select Year</option>
                                        <?php
                                        $currentYear = date('Y');
                                        for ($i = $currentYear; $i >= $currentYear - 25; $i--) {
                                            echo "<option value=\"$i\">$i</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Qualification:</label>
                                    <input type="text" name="Education_Qualification" id="qualification_education" class="form-control" placeholder="Your Qualification" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>End-Year:</label>
                                    <select name="End_Year" id="end_year_education" class="form-control" required>
                                        <option value="">Select Year</option>
                                        <?php
                                        $currentYear = date('Y');
                                        for ($i = $currentYear; $i >= $currentYear - 25; $i--) {
                                            echo "<option value=\"$i\">$i</option>";
                                        }
                                        ?>
                                    </select>                                                        </div>
                                <div class="form-group">
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary" id="Edit_Qualification">Edit-Qualification <i class="icon-arrow-right14 position-right"></i></button>
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