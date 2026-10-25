<header class="sidebar-header">
    <a class="logo-icon" href="/{{Request::segment(1)}}"><img src="/admin/assets/img/logo-icon-light.png" alt="logo icon"></a>
    <span class="logo">
          <a href="/{{Request::segment(1)}}"><img src="/admin/assets/img/logo-light.png" alt="logo"></a>
        </span>
    <span class="sidebar-toggle-fold"></span>
</header>
<nav class="sidebar-navigation">
    <ul class="menu">
        <li class="menu-category">@lang('system_variable.language_category')</li>
        @foreach($langs as $l_name)
            <li class="menu-item {{ ($lang == $l_name) ? 'active' : '' }}" style="display: inline-block;">
                <a class="menu-link" href="/{{Request::segment(1)}}/change-lang/{{$l_name}}">
                    <span class="title">{{strtoupper($l_name)}}</span>
                </a>
            </li>
        @endforeach

        @if(!empty($l_menu))
            @foreach($l_menu as $m_url => $m_conf)
                @if(!empty($m_conf['menu_category']['title']))
                    <li class="menu-category">{{$m_conf['menu_category']['title']}}</li>
                @endif
                <li class="menu-item {{(Request::segment(2) == $m_conf['link']) ? 'active' : '' }}">
                    @if(!empty($m_conf['childs']))
                        <a class="menu-link" href="#">
                            @if(!empty($m_conf['icon']))
                                <span class="icon {{$m_conf['icon']}}"></span>
                            @endif
                            <span class="title">{{$m_conf['title']}}</span>
                            <span class="arrow"></span>
                        </a>

                        <ul class="menu-submenu">
                            @foreach($m_conf['childs'] as $m_child)
                                <li class="menu-item">
                                    <a class="menu-link" href="/{{ ($m_child['link'] != null) ? \Request::segment(1) . '/' . $m_child['link'] : \Request::segment(1) }}">
                                        <span class="dot"></span>
                                        <span class="title">{{$m_child['title']}}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <a class="menu-link" href="/{{ ($m_conf['link'] != null) ? \Request::segment(1) . '/' . $m_conf['link'] : \Request::segment(1) }}">
                            @if(!empty($m_conf['icon']))
                                <span class="icon {{$m_conf['icon']}}"></span>
                            @endif
                            <span class="title">{{$m_conf['title']}}</span>
                        </a>
                    @endif
                </li>
            @endforeach
        @endif
    </ul>
</nav>