@extends('layouts.appAdmin')


<!-- Content Wrapper. Contains page content -->
@section('content')
    <div class="content-wrapper">
        @if (session('alert'))
            <section class='alert alert-success'>{{ session('alert') }}</section>
        @endif
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Quản lý tài khoản</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="/Admin">Trang chủ</a>
                            </li>
                            {{-- <li class="breadcrumb-item active">Phân công</li> --}}
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">

                                <div class="row">
                                    <div class="col-sm-2">
                                        <h3 class="btn btn-default">
                                            <a href="{{ route('Super-Admin.createAd') }}">
                                                Thêm nhân viên
                                            </a>
                                        </h3>
                                    </div>
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Mã nhân viên</th>
                                            <th>Tên nhân viên</th>
                                            <th>Địa chỉ email</th>
                                            <th>Sửa</th>
                                            <th>Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list as $value)
                                            <tr>
                                                <td>{{ $index++ }}</td>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td><a href="{{ route('Super-Admin.editAd', $value->id) }}"
                                                        class="btn btn-warning">Edit</a></td>
                                                <td>
                                                    <form id="delete-form-{{ $value->id }}"
                                                        action="{{ route('Super-Admin.delete', $value->id) }}"
                                                        method="post">
                                                        @csrf @method('DELETE')
                                                        <button class="btn btn-danger">Xóa</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>


                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
