<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trang cập nhật thể loại') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <table class="table table-white table-hover" style="text-align: center">
                        <thead>
                            <tr>
                                <th>Tên thể loại</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cate as $value)
                                <tr>

                                    <form action="{{ route('cate.update', $value->idCate) }}" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        @method("put")
                                        <input type="hidden" name="id" value="{{ $value->idCate }}">

                                        <td><input type="text" name="nameCate" value="{{ $value->nameCate }}"
                                                style="border:none"></td>

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
