<ul class="sidebar-menu">
@foreach ($menus as $menu)
    @if ($menu['is_parent'])
        @hasaccess((isset($menu['child_permissions']) ? $menu['child_permissions'] : []), true)
            <li class="treeview{!! (Request::is($menu['pattern'].'/*')) ? ' active' : '' !!}">
                <a class="menu-disabled" href="#" title="{{ $menu['display_name'] }}">
                    <i class="fa fa-{{ $menu['icon'] }}"></i> <span>{{ $menu['display_name'] }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                @if (isset($menu['child']))
                    <ul class="treeview-menu">
                        @foreach($menu['child'] as $child)
                            @hasaccess($child['name'])
                                <li{!! (url($child['href']) == Request::url() OR Request::is($child['href'].'/*')) ? ' class="active"' : '' !!}>
                                    <a href="{!! url($child['href']) !!}" title="{{ $child['display_name'] }}">
                                        <i class="fa fa-{{ $child['icon'] }}"></i> {{ $child['display_name'] }}
                                    </a>
                                </li>
                            @endhasaccess
                        @endforeach
                    </ul>
                @endif
            </li>
        @endhasaccess
    @else
        @hasaccess($menu['name'])
            <li{!! (url($menu['href']) == Request::url() OR Request::is($menu['href'].'/*')) ? ' class="active"' : '' !!}>
                <a class="menu-disabled" href="{!! url($menu['href']) !!}" title="{!! $menu['display_name'] !!}">
                    <i class="fa fa-{{ $menu['icon'] }}"></i> <span>{{ $menu['display_name'] }}</span>
                    @if($menu['name'] == 'inbox')
                        <span class="pull-right-container">
                          <span class="label label-primary pull-right" id="inbox-unread"></span>
                        </span>
                    @endif
                </a>
            </li>
        @endhasaccess
    @endif
@endforeach
</ul>