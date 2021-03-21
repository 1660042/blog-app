@extends('backend.layouts.default')
@section('title', 'Chuyên mục')
@section('content')
    <!-- Main content -->

    <section class="content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách tài khoản</h3>
                            <div class="text-right">
                                <a class=" btn btn-primary btn-sm" href="{{ route('backend.accounts.create') }}"><i
                                        class="fas fa-folder-plus"></i>&ensp;Tạo tài khoản mới</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: auto;">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle">#ID</th>
                                        <th class="text-center align-middle">Tên tài khoản</th>
                                        <th class="text-center align-middle">Username</th>
                                        <th class="text-center align-middle">Email</th>
                                        <th class="text-center align-middle">Trạng thái</th>
                                        <th class="text-center align-middle">Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($accounts as $account)

                                        <tr>
                                            <td class="text-center align-middle">#{{ $account->id }}</td>
                                            <td class="text-center align-middle">{{ $account->name }}</td>
                                            <td class="text-center align-middle">{{ $account->username }}</td>
                                            <td class="text-center align-middle">{{ $account->email }}</td>
                                            <td
                                                class="text-center align-middle {{ $account->status == '1' ? '' : 'text-danger' }}">
                                                {{ $status[$account->status] }}</td>
                                            <td class="text-center align-middle">
                                                <div class="">
                                                    <!-- <div class="col-sm-6"> -->
                                                    <a href="{{ route('backend.accounts.edit', $account->id) }}"
                                                        class="btn btn-primary btn-sm" title="Sửa chuyên mục"><i
                                                            class="far fa-edit"></i>&ensp;Sửa</a>
                                                    <!-- </div>
                                                                                                                                                <div class="col-sm-6"> -->
                                                    {{-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#modal-overlay-{{ $account->id }}">
                                                        <i class="far fa-trash-alt"></i>&ensp;Xóa
                                                    </button> --}}

                                                    {{-- <a href="/" class="btn btn-danger btn-sm" title="Xóa chuyên mục"><i class="far fa-trash-alt"></i>&ensp;Xóa</a> --}}
                                                    <!-- </div> -->

                                                </div>
                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                                {{-- <tfoot>
                        <tr>
                            <th class="text-center align-middle">ID</th>
                            <th class="text-center align-middle">Tên chuyên mục</th>
                            <th class="text-center align-middle">Chuyên mục cha</th>
                            <th class="text-center align-middle">Đường dẫn chuyên mục</th>
                            <th class="text-center align-middle">Trạng thái</th>
                            <th class="text-center align-middle">Người tạo</th>
                            <th class="text-center align-middle">Người sửa</th>
                            <th class="text-center align-middle">Tác vụ</th>
                        </tr>
                        </tfoot> --}}
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
        @foreach ($accounts as $account)
            <div class="modal fade" id="modal-overlay-{{ $account->id }}">
                <div class="modal-dialog">
                    <div class="modal-content" id="modal-content-{{ $account->id }}">

                        <div class="modal-header">
                            <h4 class="modal-title">Thông báo</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Bạn có chắc chắn xóa chuyên mục {{ $account->name }} ?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                            <button onclick="deleteCategory({{ $account->id }})" class="btn btn-danger">Xóa</button>
                        </div>
                        <form id="form-delete-{{ $account->id }}" method="POST"
                            action="{{ route('backend.posts.categories.delete', $account->id) }}">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        @endforeach
    </section>
    <!-- /.content -->
    @push('script')

        <script>
            function deleteCategory(id) {
                $('#modal-content-' + id).append(
                    "<div class=\"overlay d-flex justify-content-center align-items-center\"><i class=\"fas fa-2x fa-sync fa-spin\"></i></div>"
                )
                $('#form-delete-' + id).submit();
            }

        </script>
    @endpush
@endsection
