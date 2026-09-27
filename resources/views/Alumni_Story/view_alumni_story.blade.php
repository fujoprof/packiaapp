@extends('layouts.public_files')
@include('Profile_Detail.ajax.Middleware')
@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="col-sm-6 col-md-6">
                    <div class="thumbnail">
                        <div class="thumb">
                            <img src="assets/images/placeholder.jpg" alt="">
                            <div class="caption-overflow">
                                <span>
                                    <a href="#" class="btn bg-warning-300">Conversation</a>
                                </span>
                            </div>
                        </div>

                        <div class="caption">
                            <div class="media">
                                <a href="#" class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle" alt=""></a>
                                <div class="media-body">
                                    <h6 class="media-heading"><a href="#">Eugene Kopyov</a></h6>
                                    Delivered is to ye belonging enjoyment preferred. Astonished and acceptance men two discretion. Law education recommend...
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="sidebar-detached">
            <div class="sidebar sidebar-default" style="width: 100%;">
                <div class="sidebar-content">

                    <!-- Sidebar search -->
                    <div class="sidebar-category">
                        <div class="category-title">
                            <span>Search</span>
                            <ul class="icons-list">
                                <li><a href="#" data-action="collapse"></a></li>
                            </ul>
                        </div>

                        <div class="category-content">
                            <form action="#">
                                <div class="has-feedback has-feedback-left">
                                    <input type="search" class="form-control" placeholder="Search">
                                    <div class="form-control-feedback" style="margin-top:10px">
                                        <i class="icon-search4 text-size-base text-muted"></i>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /sidebar search -->

                    <!-- Action buttons -->
                    <div class="sidebar-category">
                        <div class="category-title">
                            <span>Action buttons</span>
                            <ul class="icons-list">
                                <li><a href="#" data-action="collapse"></a></li>
                            </ul>
                        </div>

                        <div class="category-content">
                            <div class="row">
                                <div class="col-xs-6">
                                    <button class="btn bg-teal-400 btn-block btn-float btn-float-lg" type="button"><i class="icon-git-branch"></i> <span>Branch</span></button>
                                    <button class="btn bg-purple-300 btn-block btn-float btn-float-lg" type="button"><i class="icon-mail-read"></i> <span>Messages</span></button>
                                </div>

                                <div class="col-xs-6">
                                    <button class="btn bg-warning-400 btn-block btn-float btn-float-lg" type="button"><i class="icon-stats-bars"></i> <span>Statistics</span></button>
                                    <button class="btn bg-blue btn-block btn-float btn-float-lg" type="button"><i class="icon-people"></i> <span>Users</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /action buttons -->

                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
