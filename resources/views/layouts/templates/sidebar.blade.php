<div class="sidebar sidebar-main">
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">
                    @foreach($users AS $user)
                    <a href="#" class="media-left"><img src="{{asset($user->profile_image)}}" class="img-circle img-lg" alt=""></a>
                    <div class="media-body">
                        <span class="media-heading text-semibold">{{$user->first_name}} {{$user->last_name}}</span>
                        <div class="text-size-mini text-muted">
                            <i class="icon-envelop4 text-size-small"></i> &nbsp;{{$user->email}}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">

                    <!-- Main -->
                    <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
                    @foreach($menus as $menu)
                    <?php $submenus = DB::select("SELECT * FROM `sub__menus` WHERE `menu_id` = '$menu->menu_id'");?>
                    <li @if($menu->menu_name == 'Dashboard') class='active' @endif>
                        <a href="{{route($menu->menu_route)}}"><i class="{{$menu->menu_icon}}"></i> <span>
                            {{$menu->menu_name}}
                            </span></a>
                        @foreach($submenus as $submenu)
                        <ul>
                            <li><a href="{{routze($submenu->submenu_url)}}">{{$submenu->submenu_name}}</a></li>
                        </ul>
                        @endforeach
                    </li>
                    @endforeach
                    <!-- /main -->
                                                    
                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>