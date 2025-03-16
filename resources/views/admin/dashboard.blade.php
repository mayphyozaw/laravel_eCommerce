@extends('admin.layout.master')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 m-b-3">
                <div class="card">
                    <div class="card-body">
                        <div class="m-b-1">
                            <i class="icon-layers f-30 text-blue"></i>
                        </div>
                        <div class="info-widget-text row d-flex justify-content-between">
                            <div class="col-sm-7 pull-left">
                                <span>Today Income</span>
                            </div>
                            <div class="col-sm-5 pull-right text-right text-blue f-25">
                                {{ $todayIncomeCount }}Ks
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 m-b-3">
                <div class="card">
                    <div class="card-body">
                        <div class="m-b-1"> <i class="icon-layers f-30 text-green"></i></div>
                        <div class="info-widget-text row">
                            <div class="col-sm-7 pull-left">
                                <span>Today Expenses</span>
                            </div>
                            <div class="col-sm-5 pull-right text-right text-blue f-25">{{ $todayExpenseCount }}Ks</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 m-b-3">
                <div class="card">
                    <div class="card-body">
                        <div class="m-b-1">
                            <i class="icon-people f-30 text-red"></i>
                        </div>
                        <div class="info-widget-text row">
                            <div class="col-sm-7 pull-left"><span>Users</span></div>
                            <div class="col-sm-5 pull-right text-right text-blue f-25">{{ $userCount }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 m-b-3">
                <div class="card">
                    <div class="card-body">
                        <div class="m-b-1"> <i class="icon-earphones-alt f-30 text-orange"></i></div>
                        <div class="info-widget-text row">
                            <div class="col-sm-7 pull-left"><span>Today Products</span></div>
                            <div class="col-sm-5 pull-right text-right text-blue f-25">{{ $productCount }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" hidden>
            <div class="col-lg-3">
                <div class="tile-progress tile-pink">
                    <div class="tile-header text-center">
                        <h6>Today Income</h6>
                        <h4>{{ $todayIncomeCount }}Ks</h4>
                    </div>

                </div>
            </div>
            <div class="col-lg-3">
                <div class="tile-progress tile-red">
                    <div class="tile-header text-center">
                        <h6>Today Expenses</h6>
                        <h4>{{ $todayExpenseCount }}Ks</h4>
                    </div>

                </div>
            </div>
            <div class="col-lg-3">
                <div class="tile-progress tile-cyan">
                    <div class="tile-header text-center">
                        <h6>Users</h6>
                        <h4>{{ $userCount }}</h4>
                    </div>

                </div>
            </div>
            <div class="col-lg-3">
                <div class="tile-progress tile-aqua">
                    <div class="tile-header text-center">
                        <h6>Today Products</h6>
                        <h4>{{ $productCount }}</h4>
                    </div>

                </div>
            </div>
        </div>
        <!-- /.row -->


        {{-- Chart --}}

        <div class="row">
            <div class="col-lg-6">
                <div class="info-box">
                    <div class="col-12">
                        <div class="d-flex flex-wrap">
                            <div class="m-b-1">
                                <h5>Products Sales</h5>
                            </div>
                        </div>
                        <canvas id="saleChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="info-box">
                    <div class="col-12">
                        <div class="d-flex flex-wrap">
                            <div class="m-b-1">
                                <h5>Income/Expense</h5>
                            </div>
                        </div>
                        <canvas id="inoutChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="info-box">
                    <div class="col-12" style="overflow-x:auto;">
                        <div class="m-b-1">
                            <h5>User Lists</h5>
                        </div>
                        <table class="table table-bordered">
                            <tbody>
                                @foreach ($latestUser as $u)
                                    <tr>
                                        <td>
                                            <img src="{{ $u->image_url }}" width="50" alt=""
                                                style="border-radius:50%">

                                        </td>
                                        <td>
                                            {{ $u->email }}
                                        </td>
                                        <td>
                                            <span class="badge badge-warning">
                                                {{ $u->name }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <ul class="list-group" hidden>
                            @foreach ($latestUser as $u)
                                <li class="list-group-item d-flex">
                                    <img src="{{ $u->image_url }}" width="50" alt="" style="border-radius:50%">
                                    <small>{{ $u->email }}</small>
                                    <span class="badge badge-warning">
                                        {{ $u->name }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>


            <div class="col-lg-8">
                <div class="info-box">
                    <div class="col-12">
                        <div class="m-b-1">
                            <h5>Less than 3 Product Lists</h5>
                        </div>
                        <table class="table table-border">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $p)
                                    <tr>
                                        <td>
                                            <img src="{{ $p->image_url }}" width ="50" class="round-circle"
                                                alt="">
                                        </td>
                                        <td>
                                            {{ $p->name }}
                                        </td>
                                        <td>
                                            {{ $p->total_qty }}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = @json($months);

        const data = {
            labels: labels,
            datasets: [{
                label: 'Sales Data',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: @json($saleData),
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {}
        };

        const myChart = new Chart(
            document.getElementById('saleChart'),
            config
        );


        // income expense chart
        const inoutlabels = @json($dayMonths);

        const inoutdata = {
            labels: inoutlabels,
            datasets: [{
                    label: 'Income',
                    borderColor: 'green',
                    data: @json($incomeCount),
                },

                {
                    label: 'Expense',
                    borderColor: 'red',
                    data: @json($expenseCount),
                },
            ]
        };

        const inoutconfig = {
            type: 'line',
            data: inoutdata,
            options: {}
        };

        new Chart(
            document.getElementById('inoutChart'),
            inoutconfig
        );
    </script>
@endsection
