<x-guest-layout>
    <div class="lg:w-8/12 m-auto">
        @foreach ($events as $event)
        <x-event-videos :event="$event"></x-event-videos>
        @endforeach

        <div class="bg-white">
            <h2 class="p-2 text-center text-2xl">CL is climbing a mountain and she is only half way there.</h2>
            <div id="main" style="width:1200px; height:1200px;"></div>
        </div>

        <script type="text/javascript">
            // based on prepared DOM, initialize echarts instance
        var myChart = echarts.init(document.getElementById('main'));

        // specify chart configuration item and data
        var option = {
            xAxis: {
                type: 'time',
                boundaryGap: false
            },
            yAxis: {
                type: 'value'
            },
            dataZoom: [{
            type: 'inside',
            start: 0,
            end: 20
            }, {
                start: 0,
                end: 20
            }],
            series: [{
                data: [[{!! $points !!}]],
                type: 'line',
                areaStyle: {}
            }]
        };

        // use configuration item and data specified to show chart
        myChart.setOption(option);
        </script>

        <footer class="grid sm:grid-cols-3 p-5 pl-10 bg-white rounded-lg">
            <div>
                <a class="link" href="http://support.operationsmile.org/site/TR?pg=fund&fr_id=1030&pxfid=39223">To
                    donate, simply smile.</a>
            </div>
            <div>Mail <a class="link" href="mailto:support@whereiscl.com">Support</a></div>
            <div>
                <a class="link" href="https://www.youtube.com/t/terms">YouTube ToS​</a>
            </div>
        </footer>
    </div>
</x-guest-layout>