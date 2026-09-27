@extends('layouts.pages')
	@include('Success_Story.ajax.Middleware')
@section('content')
<!-- Tabs with bottom line -->
<div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Success Story Panel</h6>
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
                                                <th>Title</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th>Created-At</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $sn = 1;?>
                                            @foreach ($success_storys as $story)
                                            <tr>
                                                <td><i class="icon-shield-check"></i> {{ $story->title }}</td> <!-- Replace 'column2' with the actual column name -->
                                                <td style="text-align: center;"><span><a href="#" id="edit_profile_image" data-id="{{ $story->id }}" data-image="{{ $story->image }}" data-title="{{ $story->title }}" data-toggle="modal" data-target="#modal_form_editing_image"><i class="icon-image3"></i></a></span></td> <!-- Replace 'column3' with the actual column name -->
                                                <td>
                                                    @if (!empty($story->created_at))
                                                        <a href="#">Published</a>
                                                    @else
                                                    <a href="#">Drafted</a>
                                                    @endif
                                                </td> <!-- Replace 'column5' with the actual column name -->
                                                <td>{{ $story->created_at }}</td> <!-- Replace 'column5' with the actual column name -->
                                                <td class="text-center">
                                                    <ul class="icons-list">
                                                        <li class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-right">
                                                                <li><a href="#" id="edit_success_story" data-id="{{ $story->id }}" data-title="{{ $story->title }}" data-content="{{ $story->content }}" data-toggle="modal" data-target="#modal_form_success_story"><i class="fa fa-pencil-square"></i>Edit</a></li>
                                                                <li><a href="#" id="trash_success_story" data-trashid="{{ $story->id }}"><i class="fa fa-trash"></i>Trash</a></li>
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
                                                    <th>Title</th>
                                                    <th>Status</th>
                                                    <th>Deleted-At</th>
                                                    <th class="text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $sn = 1;?>
                                                @foreach ($deleted_success_storys as $story)
                                                <tr>
                                                    <td><i class="icon-blocked"></i> {{ $story->title }}</td> <!-- Replace 'column2' with the actual column name -->
                                                    <td>
                                                        @if (!empty($story->deleted_at))
                                                            <a href="#">Drafted</a>
                                                        @else
                                                        <a href="#">Published</a>
                                                        @endif
                                                    </td> <!-- Replace 'column5' with the actual column name -->
                                                    <td>{{ $story->created_at }}</td> <!-- Replace 'column5' with the actual column name -->
                                                    <td class="text-center">
                                                        <ul class="icons-list">
                                                            <li class="dropdown">
                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                    <i class="icon-menu9"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-right">
                                                                    <li><a href="#" id="undo_success_story" data-restoreid="{{ $story->id }}"><i class="icon-rotate-ccw2"></i>Undo</a></li>
                                                                    <li><a href="#" id="delete_success_story" data-deleteid="{{ $story->id }}"><i class="icon-trash"></i>Delete</a></li>
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
                                {!! Form::open(['route' => 'Create-Success-Story', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'Create-Success-Story', 'file'=>'true']) !!}
                                <!-- <form action="#" id="user_form"> -->
                                    <div class="panel panel-flat">
                                    <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label for="title">Title*</label>
                                                    <input type="text" id="title" name="Title" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="content">Success-Story*</label>
                                                    <textarea id="content" name="Content" class="form-control" rows="5" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="content">Image-Post (If any)</label>
                                                    <input type="file" id="image_post" name="Image_Post" class="file-styled-primary">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit Success Story</button>
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
	
<!-- Start popup form editing success story-->
	<div id="modal_form_success_story" class="modal fade">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="background-color:info">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title">Edit Post Content</h5>
				</div>
			<!-- Start Insert show form here-->
            {!! Form::open(['route' => ['Update-Success-Story'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="panel panel-flat">
                    <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                    <input type="hidden" name="user_id" id="id_edit_story" value="">
                        <div class="panel panel-flat">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="title">Title*</label>
                                        <input type="text" id="title_edit" name="Title_Edit" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Success-Story*</label>
                                        <textarea id="content_edit" name="Content_Edit" class="form-control" rows="5" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Edit-Success-Story</button>
                                </div>
                        </div>
                </div>
            {!! Form::close() !!}
			<!-- End Insert show form here-->
			</div>
		</div>
	</div>
<!-- End popup form editing success story-->

<!-- Start popup form editing image-->
<div id="modal_form_editing_image" class="modal fade">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="background-color:info">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title">Edit Post Image</h5>
				</div>
			<!-- Start Insert show form here-->
            {!! Form::open(['route' => 'Update-Post-Image', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'Update-Post-Image']) !!}
                <div class="panel panel-flat">
                    <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                    <input type="hidden" name="user_id" id="id_image" value="">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-sm-10">
                                <div class="thumbnail">
                                    <div class="thumb">
                                        <img src="" alt="" id="post_image" name="post_image">
                                        <div class="caption-overflow">
                                            <span>
                                                <a href="{{asset('success_story/2023/11/State-of-the-Art Computer Labs and Cutting-Edge Technology.jpg')}}" id="post_image_link" data-popup="lightbox" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>
                                                <a href="#" class="btn border-white text-white btn-flat btn-icon btn-rounded ml-5"><i class="icon-link2"></i></a>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="caption">
                                        <h6 class="no-margin"><a href="#" class="text-default" id="post_title"></a> <a href="#" class="text-muted"></a></h6>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="content">Upload new image here</label>
                                    <input type="file" id="image_post" name="Image_Post" class="file-styled-primary">
                                </div>
                                <div class="form-group">
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary" id="Edit_Post_Image">Edit-Post-Image <i class="icon-arrow-right14 position-right"></i></button>
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
<!-- End popup form editing image-->
@endsection