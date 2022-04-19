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
                        <h1>Cập nhật thông tin tài khoản - {{ $info->name }}</h1>
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
                            <!-- /.card-header -->
                            <div class="card-body">
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                                <form id="frm" enctype="multipart/form-data"
                                    action="{{ route('Super-Admin.update', $info->id) }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <div class="form-group label-floating">
                                        <label class="control-label">Tên nhân viên</label>
                                        <input type="text" id="name" name="name" value="{{ $info->name }}"
                                            class="form-control" required />
                                    </div>
                                    <div class=" form-group label-floating">
                                        <label class="control-label">Email</label>
                                        <input type="text" id="email" name="email" value="{{ $info->email }}"
                                            class="form-control" required />

                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Mật khẩu</label>
                                        <input type="password" id="password" name="password" value="{{ $info->password }}"
                                            class="form-control" required />

                                    </div>
                                    <div class="form-group label-floating">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-danger">Reset</button>
                                    </div>
                                </form>
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
    <script>
    </script>
@endsection
