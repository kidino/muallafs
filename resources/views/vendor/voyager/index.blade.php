@extends('voyager::master')

@section('content')
    <div class="page-content">
        @include('voyager::alerts')
        @include('voyager::dimmers')


        <div class="clearfix container-fluid row">
            <div class="col-xs-12">
                <div class="panel widget">
                    <div class="widget-content">
                        <div class="chart-container" style="position: relative; height: 40vh; width: 80vw; padding-bottom: 40px; margin: auto;">
                            <canvas id="chart_30_days"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="panel widget">
                    <div class="widget-content">

                        last 30 days conversion by gender
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="panel widget">
                    <div class="widget-content">

                        last 30 days conversion by bangsa
                    </div>
                </div>
            </div>
        </div>


    </div>

@stop