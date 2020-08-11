@extends("Frontend.template.page_side_bar")
@section('plugins.Datatables', true)
@section('plugins.daterangepicker', true)
@section("plugins.Select2", true)

@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="full">
                <div class="main_heading text_align_center">
                    <h2>{!! $title !!}</h2>
                    <p class="large">{!! __("frontend.page.exchange_rate.index.main_heading.large",  ["dateRange" => $_GET['date_between']]) !!}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            {{$dataTable->withQueryString()->links()}}
            <table class="table table-responsive-lg table-striped" style="width:100%" id="dataTable">
                <thead class="table-primary">
                <tr>
                    <th></th>
                    <th>{!! __("label.name_bank") !!}</th>
                    <th>{!! __("label.currency_code") !!}</th>
                    <th>{!! __("label.sale") !!}</th>
                    <th>{!! __("label.purchase") !!}</th>
                    <th>{!! __("label.exchange_rate.date") !!}</th>
                </tr>
                </thead>

                <tbody>
                @foreach($dataTable as $item)
                    <tr>
                        <td>{{--{{$item->name}}--}}
                            <img class="table-avatar" style="" src="{{Storage::url($item->logo_path)}}">
                        </td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->currency_code}} - {{$item->currency_name}}</td>
                        <td>{{$item->sale}}</td>
                        <td>{{$item->purchase}}</td>
                        <td>{{$item->date}}</td>
                    </tr>
                @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th></th>
                        <th>{!! __("label.name_bank") !!}</th>
                        <th>{!! __("label.currency_code") !!}</th>
                        <th>{!! __("label.sale") !!}</th>
                        <th>{!! __("label.purchase") !!}</th>
                        <th>{!! __("label.exchange_rate.date") !!}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

@endsection

@section("side_bar")
    {{Form::open(["method" => "GET" ,"id" => "filter"])}}

    <div class="side_bar_blog">
        <h4>{{ Str::upper(__("label.filter"))  }}</h4>
        <div class="form-group">
            {{Form::label(__("label.exchange_rate.date"))}}
            <div class="input-group">
                {{Form::text("date_between", isset($_GET['date_between']) ? $_GET['date_between'] : "", ["class" => "form-control float-right", "style" => "width:100%", "id" => "date_between"])}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label(__("label.Bank"))}}
            {{Form::select("bank_id", ["%" => __("label.all")] + $filter_data["bank_id"] , isset($_GET['bank_id']) ? $_GET['bank_id'] : null, ["id" => "bank_id", "style" => "width:100%", "class" => "form-control select2",])}}
        </div>
        <div class="form-group">
            {{Form::label(__("label.currency_code"))}}
            {{Form::select("currency_code", ["%" => __("label.all")] + $filter_data["currency_code"] , isset($_GET['currency_code']) ? $_GET['currency_code'] : null, ["id" => "currency_code", "style" => "width:100%", "class" => "form-control select2",])}}
        </div>
    </div>

    <div class="side_bar_blog">
        {{Form::submit(__("label.btn_filter"), ["class" => "btn btn-outline-info"])}}
    </div>

    {{Form::close()}}
@endsection

@section("js")
    <script>
        $(function () {
            let options = {
                language: scripts.getDataTableLanguageOptions(),
                paging: false,
                lengthChange: false,
                searching: false,
                ordering: true,
                info: false,
                autoWidth: false,
                responsive: true,
            };

            let table = $("#dataTable").DataTable(options);

            table.order([[2, 'DESC']]).draw();
        });

        let datePickerLocaleOptions = scripts.getDatePickerLocaleOptions();
        datePickerLocaleOptions.format = "Y-MM-DD";

        $("#date_between").daterangepicker({
            showDropdowns: true,
            timePicker: false,
            timePicker24Hour: false,
            timePickerIncrement: 30,
            locale: datePickerLocaleOptions,
        });

        $(".select2").select2();

    </script>
@endsection
