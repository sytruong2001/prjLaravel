<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Danh sách thể loại') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">


                    <a href="{{ route('cate.create') }}" style="text-decoration: none">

                        <x-button class="ml-3">
                            {{ __('Thêm') }}
                        </x-button>
                    </a>
                    <table class="table table-white table-hover" style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Mã thể loại</th>
                                <th>Tên thể loại</th>
                                <th colspan="2">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cate as $value)
                                <tr>

                                    <td>{{ $index++ }}</td>
                                    <td>{{ $value->idCate }}</td>
                                    <td>{{ $value->nameCate }}</td>
                                    <td>
                                        <a href="{{ route('cate.edit', $value->idCate) }}"
                                            style="text-decoration: none">
                                            <x-button class="ml-3">
                                                {{ __('Sửa') }}
                                            </x-button>
                                        </a>
                                    </td>
                                    <td>
                                        @if ($value->available == 1)
                                            <a href="{{ route('cate.hide', $value->idCate) }}"
                                                style="text-decoration: none">

                                                <x-button class="ml-3">
                                                    {{ __('Ẩn') }}
                                                </x-button>
                                            </a>
                                        @else
                                            <a href="{{ route('cate.hide', $value->idCate) }}"
                                                style="text-decoration: none">

                                                <x-button class="ml-3">
                                                    {{ __('Hiện') }}
                                                </x-button>
                                            </a>
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
</x-app-layout>
