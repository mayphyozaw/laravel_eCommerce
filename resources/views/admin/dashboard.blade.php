@extends('admin.layout.master')
@section('content')
    <div class="content">
        <div class="row">
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
    </script>
@endsection
