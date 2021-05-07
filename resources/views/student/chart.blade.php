@extends('layouts.app')

@section('page-title', $student->first_name . ' ' . $student->last_name . ' Progress')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-header">{{ $student->first_name }} {{ $student->last_name }} Progress</div>
                <div class="card-body">
                    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                          <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                          <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                          <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                                {!! $chart->container()!!}
                            <div class="carousel-caption d-none d-md-block">
                              <h5>First slide label</h5>
                              <p>Some representative placeholder content for the first slide.</p>
                            </div>
                          </div>
                          <div class="carousel-item">
                            {!! $chart_medium->container() !!}
                            <div class="carousel-caption d-none d-md-block">
                              <h5>Second slide label</h5>
                              <p>Some representative placeholder content for the second slide.</p>
                            </div>
                          </div>
                          <div class="carousel-item">
                            {!! $chart_hard->container() !!}
                            <div class="carousel-caption d-none d-md-block">
                              <h5>Third slide label</h5>
                              <p>Some representative placeholder content for the third slide.</p>
                            </div>
                          </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                      </div>
                    {{--  <div class="w-1/2">
                        {!! $chart->container()!!}
                    </div>
                    <div class="w-1/2">
                        {!! $chart_medium->container() !!}
                    </div>
                    <div class="w-1/2">
                        {!! $chart_hard->container() !!}
                    </div>  --}}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
{!! $chart->script() !!}
{!! $chart_medium->script() !!}
{!! $chart_hard->script() !!}
@endsection
    {{-- <script type="text/javascript">
        var data = <?php echo json_encode($data,JSON_NUMERIC_CHECK) ?>;
        Highcharts.chart('container' ,{
            title:{
                text:'USER SCORE'
            },

            xAxis:{

                categories:['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov','Dec']
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
    </script> --}}
