@extends('backend.layouts.default')
@section('title', 'Tạo tài khoản')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-three-info-tab" data-toggle="pill"
                                        href="#custom-tabs-three-info" role="tab" aria-controls="custom-tabs-three-info"
                                        aria-selected="true">Thông tin tài khoản</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-three-roles-tab" data-toggle="pill"
                                        href="#custom-tabs-three-roles" role="tab" aria-controls="custom-tabs-three-roles"
                                        aria-selected="false">Phân quyền</a>
                                </li>
                            </ul>
                        </div>
                        <form id="form" method="POST" action="{{ route('backend.accounts.accounts.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-three-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-three-info" role="tabpanel"
                                        aria-labelledby="custom-tabs-three-info-tab">
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
                                    <div class="tab-pane fade" id="custom-tabs-three-roles" role="tabpanel"
                                        aria-labelledby="custom-tabs-three-roles-tab">

                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center align-middle">Quyền</th>
                                                    <th class="text-center align-middle">Chọn</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i = 0;
                                                @endphp
                                                @foreach ($roles as $role)
                                                    <tr>
                                                        <td class="text-center align-middle">
                                                            <label for="checkBox_{{$i}}" class="">{{ $role->name }}</label>
                                                        </td>
                                                        <td class="text-center align-middle">
                                                            <input class="" value="{{ $role->id }}" name="role_id[]" type="checkbox"
                                                                id="checkBox_{{$i}}">
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $i++;
                                                    @endphp
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th class="text-center align-middle" colspan="2"><small><span
                                                                style="color:#ff0000">*</span> Nếu không tick thì mặc định
                                                            quyền thành viên</small></th>

                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer d-flex justify-content-start">
                                <a href="{{ route('backend.accounts.accounts.index') }}" class="btn btn-dark mr-2">Quay
                                    lại</a>
                                <button type="submit" class="btn btn-primary ">Lưu</button>
                            </div>
                        </form>
                        <!-- /.card -->
                    </div>
                </div>

            </div>
    </section>
    <!-- /.content -->

@endsection
