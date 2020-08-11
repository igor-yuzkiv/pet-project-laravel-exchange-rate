<li>
    <a
        @if (isset($menu_item['route']))
        href="{{route($menu_item['route'])}}"

            @if(Request::url() == route($menu_item['route']))
                class="active"
            @endif
        @else
            href="#"
        @endif

        @if(isset($menu_item["target"]))
            target="{!! $menu_item["target"] !!}"
        @endif
    >

        @if (isset($menu_item['icon']))
            <i class="{!! $menu_item['icon'] !!}"></i>
        @endif

        @if (isset($menu_item['translate']))
            {{ __($menu_item['translate']) }}
        @elseif(isset($menu_item["text"]))
            {{$menu_item["text"]}}
        @endif
    </a>


@if(isset($menu_item['dropdown']) and !empty($menu_item['dropdown']))
    <ul>
        @each("Frontend.template.partials.navbar.menu-dropdown-item", $menu_item['dropdown'], "dropdown_menu_item")
    </ul>
@endif

</li>
