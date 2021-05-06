@extends('layouts.app')

@section('page-title', 'Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{--  @section('scripts')
<script type="text/javascript" src="https://code.highcharts.com/highcharts.js">
    var data = <?php echo json_encode($data,JSON_NUMERIC_CHECK) ?>;
    Highcharts.chart('container' ,{
        title:{
            text:'New User Growth, 2020'
        },
        subtitle:{
            text:'Source: CAI'
        },
        xAxis:{

            categories:['January', 'Febuary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
        },
        yAxis:{
            title:{
                text:'Number of New User'
            }
        },
        legend:{
            layout:'vertical',
            align:'right',
            verticalAlign:'middle'
        },
        plotOptions:{
            series:{
                allowPointSelect:true
            }
        },
        series:[{
            name:'Easy',
            data:data.easy.data
        },{
            name:'Medium',
            data:data.medium.data
        },{
            name:'Hard',
            data:data.hard.data
        }],
        responsive:{
            rules:[
                {
                    condition:{
                        maxWidth:500
                    },
                    chartOptions:{
                        legend:{
                            layout:'horizontal',
                            align:'center',
                            verticalAlign:'bottom'
                        }
                    }
                }
            ]
        }
    });
</script>
@endsection  --}}
