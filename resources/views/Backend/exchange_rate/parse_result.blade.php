@extends("Backend.layouts.page")

@section ('content')

    <div class="row">
        <div class="col-12">

            <h2 class="text-success">{{__("label.exchange_rate.parse_exchange_rate.today")}}</h2>

            <table class="table table-striped projects">
                <tbody>

                    @foreach($parseResult as $bank )

                        <tr>
                            <th colspan="2">{{$bank["name"]}}</th>
                        </tr>

                        @foreach($bank["result"] as $key => $currency)

                            <tr>
                                <td>{{$key}}</td>
                                <td>
                                    @if($currency)
                                        <span class="badge bg-success">TRUE</span>
                                    @else
                                        <span class="badge bg-warning">FALSE</span>
                                    @endif
                                </td>
                            </tr>

                        @endforeach

                    @endforeach

                </tbody>
            </table>

        </div>
    </div>

@endsection
