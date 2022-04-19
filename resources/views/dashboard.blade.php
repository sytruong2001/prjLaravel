<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- @if (isset($cate))
                        <div id="chart" data-order="{{ $cate }}"></div>

                        <!-- javascript -->

                        <script>
                            $(document).ready(function() {
                                var order = $('#chart').data('order');
                                var listOfValue = [];
                                var listOfCate = [];
                                order.forEach(function(element) {
                                    listOfCate.push(element.nameCate);
                                    listOfValue.push(element.Count);
                                });
                                console.log(listOfValue);
                                var chart = Highcharts.chart('chart', {

                                    title: {
                                        text: 'Products of Categories'
                                    },

                                    subtitle: {
                                        text: '---------'
                                    },

                                    xAxis: {
                                        categories: listOfCate,
                                    },

                                    series: [{
                                        type: 'column',
                                        colorByPoint: true,
                                        data: listOfValue,
                                        showInLegend: false
                                    }]
                                });

                                $('#plain').click(function() {
                                    chart.update({
                                        chart: {
                                            inverted: false,
                                            polar: false
                                        },
                                        subtitle: {
                                            text: 'Plain'
                                        }
                                    });
                                });

                                $('#inverted').click(function() {
                                    chart.update({
                                        chart: {
                                            inverted: true,
                                            polar: false
                                        },
                                        subtitle: {
                                            text: 'Inverted'
                                        }
                                    });
                                });

                                $('#polar').click(function() {
                                    chart.update({
                                        chart: {
                                            inverted: false,
                                            polar: true
                                        },
                                        subtitle: {
                                            text: 'Polar'
                                        }
                                    });
                                });
                            });
                        </script>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
