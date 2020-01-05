<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ route('manage') }}" class="site_title"><span>OJAL</span></a>
        </div>
        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                @if(auth()->user()->foto==null)
                    <img src="{{url('')}}/media/no_avatar.png" alt="" class="img-circle profile_img" />
                @else
                    <img src="{{url(auth()->user()->foto)}}" alt="" class="img-circle profile_img" />
                @endif
            </div>
            <div class="profile_info">
                <span>Selamat Datang,</span>
                <h2><strong>{{ auth()->user()->name }}</strong></h2>
            </div>
        </div>
        <!-- /menu profile quick info -->
        
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <br/>
            <div class="menu_section">
            <ul class="nav side-menu">
                <li>
                    <a href="{{route('manage')}}"><i class="fa fa-home"></i><span>&nbsp;Beranda</span></a>
                </li>                   
            </ul>
        </div>
            @include('includes/sidebar-dynamic')
        </div>
        <!-- /sidebar menu -->
    </div>
</div>