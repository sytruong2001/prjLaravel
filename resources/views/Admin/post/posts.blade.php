@extends('layouts.appAdmin')


<!-- Content Wrapper. Contains page content -->
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Quản lý bài viết</h1>
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
                                            <a href="/Admin/add-post">
                                                Thêm bài viết
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
                                            <th>Mã bài viết</th>
                                            <th>Tiêu đề</th>
                                            <th>Mô tả</th>
                                            <th>Sửa</th>
                                            <th>Xoá</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($post as $value)
                                            <tr style="max-height: 70px; overflow-y: auto;">
                                                <td>{{ $index++ }}</td>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->title }}</td>
                                                <td>{{ $value->description }}</td>
                                                <td><a href="{{ route('Admin.edit', $value->id) }}"
                                                        class="btn btn-warning">Edit</a></td>
                                                <td>
                                                    <form id="delete-{{ $value->id }}"
                                                        action="{{ route('Admin.delete-post', $value->id) }}"
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
