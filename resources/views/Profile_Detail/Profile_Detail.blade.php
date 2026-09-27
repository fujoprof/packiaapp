@extends('layouts.pages')
	@include('Profile_Detail.ajax.Middleware')
@section('content')
<!-- Tabs with bottom line -->
<div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="thumb">
                                @foreach($users AS $user)
                                <img src="{{asset($user->profile_image)}}" alt="" style="margin-bottom:5px; height:230px;">
                                <div class="form-group">
                                    <hr>
                                    <a href="#" class="icon-pencil7" id="edit_profile_image_data" data-profileid="{{$user->user_id}}" data-toggle="modal" data-target="#modal_form_editing_image_data">Edit Image</a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-3" style="line-height:1.5">
                            <p><b>Personal Profile</b> <a href="#" id="edit_personal_profile_data" data-profileid="{{$user->user_id}}" data-address="{{$user->address}}" data-phonenumber="{{$user->phone_number}}" data-toggle="modal" data-target="#modal_form_personal_details_data"> <i class="icon-pencil6"></i></a></p>
                            <hr>
                            <p><b>First-Name:</b> {{$user->first_name}}</p>
                            <p><b>Middle-Name:</b> {{$user->middle_name}}</p>
                            <p><b>Last-Name:</b> {{$user->last_name}}</p>
                            <p><b>Address:</b> {{$user->address}}</p>
                            <p><b>Date-of-Birth:</b> {{$user->date_of_birth}}</p>
                            <p><b>Phone-Number:</b> {{$user->phone_number}}</p>
                            <p><b>Email:</b> {{$user->email}}</p>
                        </div>
                        <div class="col-md-7" style="line-height:2.0">
                        @foreach($profile_details AS $profile_detail)
                            <p style="text-align:justify"><b>Biography:</b> {{ $profile_detail->biography }} <a href="#" id="edit_biography_data" data-profileid="{{$user->user_id}}" data-biography="{{$profile_detail->biography}}" data-toggle="modal" data-target="#modal_form_biography_data"><i class="icon-pencil7"></i></a></p>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <!-- /tabs with bottom line -->

<!-- Start popup form editing profile image-->
<div id="modal_form_editing_image_data" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color:info">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Edit Profile Image</h5>
            </div>
        <!-- Start Insert show form here-->
        {!! Form::open(['route' => 'Edit-Profile-Image', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'Update-Post-Image']) !!}
            <div class="panel panel-flat">
                <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                <input type="hidden" name="user_id" id="id_profile_image" value="">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-10">
                            <div class="form-group">
                                <label for="content">Upload new image here</label>
                                <input type="file" name="profile_image_data" class="file-styled-primary">
                            </div>
                            <div class="form-group">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary" id="Edit_Profile_Imagw_Data">Edit-Profile-Image <i class="icon-arrow-right14 position-right"></i></button>
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
<!-- End popup form editing profile image--> 

<!-- Start popup form editing personal profile data-->
<div id="modal_form_personal_details_data" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
				<div class="modal-header" style="background-color:info">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title">Edit Personal Profile Data</h5>
				</div>
			<!-- Start Insert show form here-->
            {!! Form::open(['route' => ['Edit-Profile-Data'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="panel panel-flat">
                    <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                    <input type="hidden" name="user_id" id="id_edit_personal_profile_data" value="">
                        <div class="panel panel-flat">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="title">Address</label>
                                    <input type="text" id="edit_address" name="Edit_Address" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="content">Phone-Number</label>
                                    <input type="text" id="phone_number" name="Phone_Number" class="form-control" rows="5" required>
                                </div>
                                    <button type="submit" class="btn btn-primary">Edit-Details</button>
                            </div>
                        </div>
                </div>
            {!! Form::close() !!}
			<!-- End Insert show form here-->
		</div>
	</div>
</div>
<!-- End popup form editing personal profile data-->

<!-- Start popup form editing biography-->
<div id="modal_form_biography_data" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
				<div class="modal-header" style="background-color:info">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title">Edit Biography Data</h5>
				</div>
			<!-- Start Insert show form here-->
            {!! Form::open(['route' => ['Edit-Biography-Data'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="panel panel-flat">
                    <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                    <input type="hidden" name="user_id" id="id_edit_biography_data" value="">
                        <div class="panel panel-flat">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="content">Biography Data</label>
                                    <textarea style="text-align:justify" id="biography_data" name="Biography_Data" class="form-control" rows="5" required></textarea>
                                </div>
                                    <button type="submit" class="btn btn-primary">Edit-Biography</button>
                            </div>
                        </div>
                </div>
            {!! Form::close() !!}
			<!-- End Insert show form here-->
		</div>
	</div>
</div>
<!-- End popup form editing biography-->
@endsection