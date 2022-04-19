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
                    <h1 id="demo"></h1>
                    <h1 id="demo1" style="display: block">Hiện</h1>
                    {{-- <button type="button"
                        onclick='document.getElementById("demo").innerHTML = "Hello JavaScript!"'>Click
                        Me!</button> --}}
                    <button type="button" onclick='change()'>Click Me!</button>

                    <button type="button" onclick="hide()">Ẩn</button>
                    <button type="button" onclick="up()">Hiện</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function change() {
            $('#demo').html("Hello World!");
        }

        function hide() {
            // document.getElementById('demo1').style.display = "none";
            $('#demo').modal('hide');
        }

        function up() {
            document.getElementById('demo1').style.display = "block";
        }
    </script>
</x-app-layout>
