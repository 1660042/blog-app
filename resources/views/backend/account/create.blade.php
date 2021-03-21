@extends('backend.layouts.default')
@section('title', 'Tạo tài khoản')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tài khoản</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="form" method="POST" action="{{ route('backend.accounts.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="text-danger">{{ $errors->first('name') }}</label></br>
                                    <label for="">Tên tài khoản</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Nhập tên tài khoản">
                                </div>

                                <div class="form-group">
                                    <label class="text-danger">{{ $errors->first('username') }}</label></br>
                                    <label for="">Username</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        placeholder="Nhập Username">
                                </div>
                                <div class="form-group">
                                    <label class="text-danger">{{ $errors->first('email') }}</label></br>
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Nhập Email">
                                </div>
                                <div class="form-group">
                                    <label class="text-danger">{{ $errors->first('password') }}</label></br>
                                    <label for="">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Nhập Password">
                                </div>
                                <div class="form-group">
                                    <label class="text-danger">{{ $errors->first('status') }}</label></br>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" value="1" name="status" type="checkbox"
                                            id="customCheckbox1" checked>
                                        <label for="customCheckbox1" class="custom-control-label">Hoạt động</label>
                                    </div>

                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer d-flex justify-content-start">
                                <a href="{{ route('backend.accounts.index') }}" class="btn btn-dark mr-2">Quay
                                    lại</a>
                                <button type="submit" class="btn btn-primary ">Lưu</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
