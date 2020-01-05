<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        @if(auth()->user()->foto==null)
                             <img src="{{url('')}}/media/no_avatar.png" alt="" class="img-rounded img-thumbnail" />
                        @else
                             <img src="{{url(auth()->user()->foto)}}" alt="" class="img-rounded img-thumbnail" />
                        @endif
                       
                        {{auth()->user()->name }}
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li>
                            <a href=""><i class="fa fa-user pull-left"></i> Profil</a>
                        </li>
                        <li><a href="{{ route('manage.logout') }}"><i class="fa fa-sign-out pull-left"></i> Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->
