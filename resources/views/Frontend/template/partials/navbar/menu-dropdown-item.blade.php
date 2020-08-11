<li>
    <a
        @if (isset($dropdown_menu_item['route']))
        href="{{route($dropdown_menu_item['route'])}}"

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
        @if (isset($menu_item['translate']))
            {{ __($menu_item['translate']) }}
        @elseif(isset($menu_item["text"]))
            {{$menu_item["text"]}}
        @endif
    </a>

</li>
{{--$dropdown_menu_item--}}
