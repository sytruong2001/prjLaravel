<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Danh sách thành viên') }}
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
                    <table class="table table-white table-hover" style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Mã thành viên</th>
                                <th>Họ và tên</th>
                                <th>Email</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($infoUser as $value)
                                <tr>
                                    <td>{{ $index++ }}</td>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>
                                        <a href="/chat/show/{{ $value->id }}" style="text-decoration: none">
                                            <x-button class="ml-3">
                                                {{ __('Chat') }}
                                            </x-button>
                                        </a>
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
