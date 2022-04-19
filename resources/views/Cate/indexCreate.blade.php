<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trang thêm thể loại') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (Session::exists('message'))
                        <p style="color:rgb(34, 6, 111); text-align:center;">
                            {{ Session::get('message') }}
                        </p>
                    @elseif(Session::exists('errors'))
                        <p style="color:rgb(193, 12, 18); text-align:center;">
                            {{ Session::get('errors') }}
                        </p>
                    @endif
                    <table class="table table-white table-hover" style="text-align: center">
                        <thead>
                            <tr>
                                <th>Tên thể loại</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <form action="{{ route('cate.store') }}" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <td><input type="text" name="nameCate" style="border:none"
                                            placeholder="Nhập tên thể loại"></td>


                            <tr>
                                <td colspan="4">
                                    <x-button class="ml-3">
                                        {{ __('Thêm thể loại') }}
                                    </x-button>
                                </td>
                            </tr>

                            </form>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
