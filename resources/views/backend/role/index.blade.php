@extends('backend.layouts.default')
@section('title', 'Quyền')
@section('content')
    <!-- Main content -->

    <section class="content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách quyền</h3>
                            <div class="text-right">
                                <a class=" btn btn-primary btn-sm" href="{{ route('backend.systems.roles.create') }}"><i
                                        class="fas fa-folder-plus"></i>&ensp;Tạo quyền mới</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: auto;">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle">#ID</th>
                                        <th class="text-center align-middle">Mã quyền</th>
                                        <th class="text-center align-middle">Tên quyền</th>
                                        <th class="text-center align-middle">Mô tả</th>
                                        <th class="text-center align-middle">Trạng thái</th>
                                        <th class="text-center align-middle">Người tạo</th>
                                        <th class="text-center align-middle">Ngày tạo</th>
                                        <th class="text-center align-middle">Người sửa</th>
                                        <th class="text-center align-middle">Ngày sửa</th>
                                        <th class="text-center align-middle">Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($roles as $role)

                                        <tr>
                                            <td class="text-center align-middle">#{{ $role->id }}</td>
                                            <td class="text-center align-middle">{{ $role->code }}</td>
                                            <td class="text-center align-middle">{{ $role->name }}</td>
                                            <td class="text-center align-middle">{{ $role->description }}</td>

                                            <td
                                                class="text-center align-middle {{ $role->status == '1' ? '' : 'text-danger' }}">
                                                {{ $status[$role->status] }}</td>
                                            <td class="text-center align-middle">
                                                {{ $role->createdBy == null ? '' : $role->createdBy->name }}</td>
                                            <td class="text-center align-middle">{{ $role->created_at }}</td>
                                            <td class="text-center align-middle">
                                                {{ $role->updatedBy == null ? '' : $role->updatedBy->name }}</td>
                                            <td class="text-center align-middle">{{ $role->created_at }}</td>
                                            <td class="text-center align-middle">
                                                <div class="">
                                                    <!-- <div class="col-sm-6"> -->
                                                    <a href="{{ route('backend.systems.roles.edit', $role->id) }}"
                                                        class="btn btn-primary btn-sm" title="Sửa chuyên mục"><i
                                                            class="far fa-edit"></i>&ensp;Sửa</a>
                                                    <!-- </div>
                                                                                                                            <div class="col-sm-6"> -->
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#modal-overlay-{{ $role->id }}">
                                                        <i class="far fa-trash-alt"></i>&ensp;Xóa
                                                    </button>

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
        @foreach ($roles as $role)
            <div class="modal fade" id="modal-overlay-{{ $role->id }}">
                <div class="modal-dialog">
                    <div class="modal-content" id="modal-content-{{ $role->id }}">

                        <div class="modal-header">
                            <h4 class="modal-title">Thông báo</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Bạn có chắc chắn xóa chuyên mục {{ $role->name }} ?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                            <button onclick="deleteCategory({{ $role->id }})" class="btn btn-danger">Xóa</button>
                        </div>
                        <form id="form-delete-{{ $role->id }}" method="POST"
                            action="{{ route('backend.posts.categories.delete', $role->id) }}">
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
