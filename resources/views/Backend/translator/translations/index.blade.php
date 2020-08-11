@extends("Backend.layouts.dataTable")

@section("control_card")
    <a href="{{route("backend.translator.translations.create")}}"class="btn btn-outline-success"><i class="fa fa-plus"></i>{{__("label.buttons.add")}}</a>
@endsection

@section("table_header")
    <tr>
        <th></th>
        <th>{!! __("form.translations.attr.full_patch") !!}</th>
        <th>{!! __("form.translations.attr.text") !!}</th>
        <th>{!! __("form.translations.attr.locale") !!}</th>
        <th>{!! __("form.translations.attr.namespace") !!}</th>
        <th>{!! __("form.translations.attr.group") !!}</th>
        <th>{!! __("form.translations.attr.item") !!}</th>
        <th>{!! __("form.base.attr.created") !!}</th>
        <th>{!! __("form.base.attr.updated") !!}</th>
    </tr>
@endsection

@section("table_body")
    @foreach($dataTable as $item)
        <tr>
            <th>
                <a href="{{route("backend.translator.translations.edit", $item->id)}}" title="{!! __("label.edit") !!}" class="btn btn-sm btn-outline-warning"><i class="fa fa-edit"></i></a>
                <button data-href="{{route("backend.translator.destroy-language", $item->id)}}" class="btn btn-sm btn-outline-danger deleteItem">
                    <i class="fa fa-trash"></i>
                </button>
            </th>
            <th>{!! $item->group !!}.{!! $item->item !!} </th>
            <th>{!! \Illuminate\Support\Str::limit($item->text, 80, "...") !!}</th>
            <td  class="w-25">{!! $item->locale !!}</td>
            <td>{!! $item->namespace !!}</td>
            <td>{!! $item->group !!}</td>
            <td>{!! $item->item !!}</td>
            <td>{!! $item->created_at !!}</td>
            <td>{!! $item->updated_at !!}</td>
        </tr>
    @endforeach
@endsection

@section("table_footer")
    <tr>
        <th></th>
        <th>{!! __("form.translations.attr.full_patch") !!}</th>
        <th>{!! __("form.translations.attr.text") !!}</th>
        <th>{!! __("form.translations.attr.locale") !!}</th>
        <th>{!! __("form.translations.attr.namespace") !!}</th>
        <th>{!! __("form.translations.attr.group") !!}</th>
        <th>{!! __("form.translations.attr.item") !!}</th>
        <th>{!! __("form.base.attr.created") !!}</th>
        <th>{!! __("form.base.attr.updated") !!}</th>
    </tr>
@endsection

@section("js")
    @parent
    <script>
        $(".deleteItem").on("click", function () {
            let href = $(this).attr("data-href");
            scripts.confirmDeleteItemByHref(href)
        })
    </script>
@stop


