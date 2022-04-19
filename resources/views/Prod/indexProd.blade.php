<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Danh sách sản phẩm') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if (Session::exists('errors'))
                        <p style="color:rgb(184, 3, 30); text-align:center;">
                            {{ Session::get('errors') }}
                        </p>
                    @endif
                    <a onclick="create()" style="text-decoration: none">

                        <x-button class="ml-3">
                            {{ __('Thêm') }}
                        </x-button>
                    </a>
                    <table class="table table-white table-hover" style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Mã sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Thể loại</th>
                                <th>Mô tả</th>
                                <th colspan="2">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $value)
                                <tr>
                                    <td>{{ $index++ }}</td>
                                    <td>{{ $value->idProd }}</td>
                                    <td>{{ $value->nameProd }}</td>
                                    <td>{{ $value->nameCate }}</td>
                                    <td>{{ $value->description }}</td>
                                    <td>
                                        <a href="{{ route('product.edit', $value->idProd) }}"
                                            style="text-decoration: none">
                                            <x-button class="ml-3">
                                                {{ __('Sửa') }}
                                            </x-button>
                                        </a>
                                    </td>
                                    <td>
                                        @if ($value->available == 1)
                                            <a href="{{ route('product.hide', $value->idProd) }}"
                                                style="text-decoration: none">

                                                <x-button class="ml-3">
                                                    {{ __('Hiện') }}
                                                </x-button>
                                            </a>
                                        @elseif($value->available == null)
                                            @if ($value->cateAvailable == 0)
                                                <a href="{{ route('product.hide', $value->idProd) }}"
                                                    style="text-decoration: none">

                                                    <x-button class="ml-3">
                                                        {{ __('Hiện') }}
                                                    </x-button>
                                                </a>
                                            @elseif ($value->cateAvailable == 1)
                                                <a href="{{ route('product.hide', $value->idProd) }}"
                                                    style="text-decoration: none">

                                                    <x-button class="ml-3">
                                                        {{ __('Ẩn') }}
                                                    </x-button>
                                                </a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function create() {
            window.location = '/product/create'
        }


        function add() {
            $.ajax({
                type: "get",
                url: "/product/create",
                dataType: "json",
                success: function(data) {
                    console.log($data);
                }
            });
        }
    </script>
</x-app-layout>
