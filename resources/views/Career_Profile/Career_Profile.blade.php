@extends('layouts.pages')
	@include('Career_Profile.ajax.Middleware')
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
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-3" style="line-height:1.5">
                            <p><b>Personal Profile</b></p>
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
                            <p style="text-align:justify"><b>Biography:</b> {{ $profile_detail->biography }}</p>
                        @endforeach
                        </div>
                    </div>
                    <table class="table table-striped table-sm">
                            <!-- Education Background -->    
                            <tr>
                                <td style="font-weight:bold; font-size:16px;" colspan="3">Education Background</td>
                            </tr>
                            <tr style="font-weight:bold;">
                                <td style="width: 20%;">Start-Year</td>
                                <td style="width: 20%;">End-Year</td>
                                <td style="width: 60%;">Organization</td>
                            </tr>
                            @foreach ($education_backgrounds as $background)
                            <tr>
                                <td>{{ $background->start_year }}</td>
                                <td>{{ $background->end_year }}</td>
                                <td>{{ $background->qualification }}</td>
                            </tr>
                            @endforeach
                    </table>
                    <table class="table table-striped table-sm">
                            <!-- Working Experience --> 
                            <tr>
                                <td style="font-weight:bold; font-size:16px;" colspan="3">Working Experience</td>
                            </tr>
                            <tr style="font-weight:bold;">
                                <td style="width: 20%;">Start-Year</td>
                                <td style="width: 20%;">End-Year</td>
                                <td style="width: 60%;">Organization</td>
                            </tr>
                            @foreach ($working_experiences as $working)
                            <tr>
                                <td>{{ $working->start_year }}</td>
                                <td>{{ $working->end_year }}</td>
                                <td>{{ $working->organization }}</td>
                            </tr>
                            @endforeach
                    </table>
                    <table class="table table-striped table-sm">
                    <!-- Personal Skills --> 
                        <tr>
                            <td style="font-weight:bold; font-size:16px;" colspan="3">Personal Skills</td>
                        </tr>
                        @foreach ($personal_skills as $skill)
                        <tr>
                            <td colspan="3"><i class="icon-checkmark2"></i> {{ $skill->skill }}</td>
                        </tr>
                        @endforeach
                    </table>
                    <table class="table table-striped table-sm">
                        <!-- Interested Area --> 
                        <tr>
                            <td style="font-weight:bold; font-size:16px;" colspan="3">Area of Interest</td>
                        </tr>
                        @foreach ($interested_areas as $area)
                        <tr>
                            <td colspan="3"><i class="icon-checkmark2"></i> {{ $area->expertise }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div> 
    </div>
    <!-- /tabs with bottom line -->
@endsection