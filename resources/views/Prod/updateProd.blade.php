<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trang cập nhật sản phẩm') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <table class="table table-white table-hover" style="text-align: center">
                        <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Thể loại</th>
                                <th>Mô tả</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product as $value)
                                <tr>
                                    <form action="{{ route('product.update', $value->idProd) }}" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        @method("put")
                                        <input type="hidden" name="id" value="{{ $value->idProd }}">

                                        <td><input type="text" name="nameProd" value="{{ $value->nameProd }}"
                                                style="border:none"></td>
                                        <td>
                                            <select name="idCate" style="border:none">
                                                @foreach ($cate as $item)
                                                    <option @if ($item->idCate == $value->idCate) {{ 'selected' }} @endif
                                                        value="{{ $item->idCate }}">
                                                        {{ $item->nameCate }}</option>
                                                @endforeach
                                            </select>
                                        </td>


                                        <td>
                                            <input type="text" name="description" value="{{ $value->description }}"
                                                style="border:none">
                                        </td>
                                <tr>
                                    <td colspan="4">
                                        <x-button class="ml-3">
                                            {{ __('Cập nhật') }}
                                        </x-button>
                                    </td>
                                </tr>


                                </form>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
