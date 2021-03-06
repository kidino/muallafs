@extends('voyager::master')

@section('content')
    <div class="page-content">
        @include('voyager::alerts')
        @include('voyager::dimmers')


        <div class="clearfix container-fluid row">
            <div class="col-xs-12">
                <div class="panel widget">
                    <div class="widget-content">
                        <div class="chart-container" style="position: relative; height: 40vh; width: 80vw; margin: auto;">
                            <canvas id="chart_30_days"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix container-fluid row">
            <div class="col-sm-6">
                <div class="panel widget">
                    <div class="widget-content">
                        <div class="chart-container" style="position: relative; height: 40vh; width: 40vw; margin: auto;">
                            <canvas id="chart_gender"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="panel widget">
                    <div class="widget-content">

                        <div class="chart-container" style="position: relative; height: 40vh; width: 40vw; margin: auto;">
                            <canvas id="chart_race"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop