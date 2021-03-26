@extends('backend.layouts.default')
@section('title', 'Tạo quyền mới')

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
                            <h3 class="card-title">Quyền</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="form" method="POST" action="{{ route('backend.systems.roles.update', $role->id) }}">
                            @csrf
                            @method("PUT")
                            <div class="card-body">
                                <div class="form-group">
                                    @if ($errors->first('code'))
                                        <label class="text-danger">{{ $errors->first('code') }}</label></br>
                                    @endif
                                    <label for="">Mã quyền</label>
                                    <input type="text" class="form-control" id="code" name="code"
                                        value="{{ $role->code }}" placeholder="Nhập mã quyền">
                                </div>
                                <div class="form-group">
                                    @if ($errors->first('name'))
                                        <label class="text-danger">{{ $errors->first('name') }}</label></br>
                                    @endif
                                    <label for="">Tên quyền</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $role->name }}" placeholder="Nhập tên quyền">
                                </div>
                                <div class="form-group">
                                    @if ($errors->first('description'))
                                        <label class="text-danger">{{ $errors->first('description') }}</label></br>
                                    @endif
                                    <label for="">Mô tả</label>
                                    <input type="text" class="form-control" id="description" name="description"
                                        placeholder="Nhập mô tả" value="{{ $role->description }}">
                                </div>

                                <div class="form-group">
                                    @if ($errors->first('status'))
                                        <label class="text-danger">{{ $errors->first('status') }}</label></br>
                                    @endif
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" value="1" name="status" type="checkbox"
                                            id="customCheckbox1" {{ $role->status == 1 ? 'checked' : '' }}>
                                        <label for="customCheckbox1" class="custom-control-label">Hoạt động</label>
                                    </div>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 10px">Ứng dụng</th>
                                            <th class="text-center">
                                                Ứng dụng con
                                            </th>
                                            <th class="text-center">
                                                <div class="custom-control custom-checkbox">

                                                    <input class="custom-control-input" value="1" name="indexAllTitle"
                                                        type="checkbox" id="indexAllTitle"
                                                        onclick="checkBoxChecked('indexAllTitle', 'indexAll')">
                                                    <label for="indexAllTitle" class="custom-control-label">Hiển thị
                                                        ALL</label>
                                                </div>
                                            </th>
                                            <th class="text-center">
                                                <div class="custom-control custom-checkbox">

                                                    <input class="custom-control-input" value="1" name="indexTitle"
                                                        type="checkbox" id="indexTitle"
                                                        onclick="checkBoxChecked('indexTitle', 'index')">
                                                    <label for="indexTitle" class="custom-control-label">Hiển thị</label>
                                                </div>
                                            </th>
                                            <th class="text-center">
                                                <div class="custom-control custom-checkbox">

                                                    <input class="custom-control-input" value="1" name="showTitle"
                                                        type="checkbox" id="showTitle"
                                                        onclick="checkBoxChecked('showTitle', 'show')">
                                                    <label for="showTitle" class="custom-control-label">Xem</label>
                                                </div>
                                            </th>
                                            <th class="text-center">
                                                <div class="custom-control custom-checkbox">

                                                    <input class="custom-control-input" value="1" name="createTitle"
                                                        type="checkbox" id="createTitle"
                                                        onclick="checkBoxChecked('createTitle', 'create')">
                                                    <label for="createTitle" class="custom-control-label">Tạo</label>
                                                </div>
                                            </th>
                                            <th class="text-center">
                                                <div class="custom-control custom-checkbox">

                                                    <input class="custom-control-input" value="1" name="editTitle"
                                                        type="checkbox" id="editTitle"
                                                        onclick="checkBoxChecked('editTitle', 'edit')">
                                                    <label for="editTitle" class="custom-control-label">Sửa</label>
                                                </div>
                                            </th>
                                            <th class="text-center">
                                                <div class="custom-control custom-checkbox">

                                                    <input class="custom-control-input" value="1" name="deleteTitle"
                                                        type="checkbox" id="deleteTitle"
                                                        onclick="checkBoxChecked('deleteTitle', 'delete')">
                                                    <label for="deleteTitle" class="custom-control-label">Xóa</label>
                                                </div>
                                            </th>
                                            <th class="text-center">
                                                <div class="custom-control custom-checkbox">

                                                    <input class="custom-control-input" value="1" name="censorTitle"
                                                        type="checkbox" id="censorTitle"
                                                        onclick="checkBoxChecked('censorTitle', 'censor')">
                                                    <label for="censorTitle" class="custom-control-label">Duyệt</label>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $menuTemp = '';
                                            $i = 0;
                                        @endphp
                                        @foreach ($menus as $menu)
                                            <tr>
                                                @if ($menu->getParentMenu->id != $menuTemp)
                                                    <td
                                                        rowspan="{{ $menu->getParentMenu->getChildMenus->where('status', '=', '1')->where('is_show_role', '=', 1)->count() }}">
                                                        {{ $menu->getParentMenu->name }}</td>
                                                @endif

                                                @php
                                                    $menuTemp = $menu->getParentMenu->id;
                                                @endphp




                                                <td>
                                                    <span
                                                        onclick="tickMenu({{ $i }})">{{ $menu->name }}</span>
                                                    <input class="custom-control-input" value="{{ $menu->id }}"
                                                        name="menuId[]" type="hidden">
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" value="{{ $menu->id }}"
                                                            name="indexAll[]" type="checkbox"
                                                            id="indexAll_{{ $i }}"
                                                            onclick="checkInputCheckedAll('indexAll')"
                                                            {{ $role->getPermissions->where('menu_id', '=', $menu->id)->first() != null && $role->getPermissions->where('menu_id', '=', $menu->id)->first()->indexAll == 1 ? 'checked' : '' }}>
                                                        <label for="indexAll_{{ $i }}"
                                                            class="custom-control-label"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" value="{{ $menu->id }}"
                                                            name="index[]" type="checkbox" id="index_{{ $i }}"
                                                            onclick="checkInputCheckedAll('index')"
                                                            {{ $role->getPermissions->where('menu_id', '=', $menu->id)->first() != null && $role->getPermissions->where('menu_id', '=', $menu->id)->first()->index == 1 ? 'checked' : '' }}>
                                                        <label for="index_{{ $i }}"
                                                            class="custom-control-label"></label>
                                                    </div>
                                                </td>

                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" value="{{ $menu->id }}"
                                                            name="show[]" type="checkbox" id="show_{{ $i }}"
                                                            onclick="checkInputCheckedAll('show')"
                                                            {{ $role->getPermissions->where('menu_id', '=', $menu->id)->first() != null && $role->getPermissions->where('menu_id', '=', $menu->id)->first()->show == 1 ? 'checked' : '' }}>
                                                        <label for="show_{{ $i }}"
                                                            class="custom-control-label"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" value="{{ $menu->id }}"
                                                            name="create[]" type="checkbox" id="create_{{ $i }}"
                                                            onclick="checkInputCheckedAll('create')"
                                                            {{ $role->getPermissions->where('menu_id', '=', $menu->id)->first() != null && $role->getPermissions->where('menu_id', '=', $menu->id)->first()->create == 1 ? 'checked' : '' }}>
                                                        <label for="create_{{ $i }}"
                                                            class="custom-control-label"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" value="{{ $menu->id }}"
                                                            name="edit[]" type="checkbox" id="edit_{{ $i }}"
                                                            onclick="checkInputCheckedAll('edit')"
                                                            {{ $role->getPermissions->where('menu_id', '=', $menu->id)->first() != null && $role->getPermissions->where('menu_id', '=', $menu->id)->first()->edit == 1 ? 'checked' : '' }}>
                                                        <label for="edit_{{ $i }}"
                                                            class="custom-control-label"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" value="{{ $menu->id }}"
                                                            name="delete[]" type="checkbox" id="delete_{{ $i }}"
                                                            onclick="checkInputCheckedAll('delete')"
                                                            {{ $role->getPermissions->where('menu_id', '=', $menu->id)->first() != null && $role->getPermissions->where('menu_id', '=', $menu->id)->first()->delete == 1 ? 'checked' : '' }}>
                                                        <label for="delete_{{ $i }}"
                                                            class="custom-control-label"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" value="{{ $menu->id }}"
                                                            name="censor[]" type="checkbox" id="censor_{{ $i }}"
                                                            onclick="checkInputCheckedAll('censor')"
                                                            {{ $role->getPermissions->where('menu_id', '=', $menu->id)->first() != null && $role->getPermissions->where('menu_id', '=', $menu->id)->first()->censor == 1 ? 'checked' : '' }}>
                                                        <label for="censor_{{ $i }}"
                                                            class="custom-control-label"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    </tbody>

                                </table>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer d-flex justify-content-start">
                                <a href="{{ route('backend.systems.roles.index') }}" class="btn btn-dark mr-2">Quay
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

    @push('ajax_slug')
        <script>
            function getSlug() {
                var _token = $('input[name="_token"]').val();
                //console.log(token);
                $.ajax({
                    type: 'POST', //THIS NEEDS TO BE GET
                    url: "{{ route('backend.ajax.slug') }}",
                    //dataType: 'json',
                    data: {
                        "_token": _token,
                        "name": $('#name').val(),
                    },
                    // beforeSend: function(xhr) {
                    // 	xhr.setRequestHeader('x-csrf-token', _token);
                    // },
                    success: function(data) {
                        $('#slug').val(data);
                        //console.log("thành công: " + data);
                    },
                    error: function(data, xhr) {
                        console.log("thất bại");
                    }
                });
            }

        </script>
    @endpush

    @push('script')
        <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
        {{-- <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script> --}}

        <script src="{{ url('/') }}/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
        <script>
            var _token = $('input[name="_token"]').val();
            //alert(_token);
            var options = {
                filebrowserImageBrowseUrl: '{{ url('/dashboard') }}/laravel-filemanager?type=Images',
                filebrowserFlashUploadUrl: '{{ url('/dashboard') }}/laravel-filemanager/upload?type=Files&_token=' +
                    _token,
                filebrowserFlashBrowseUrl: '{{ url('/dashboard') }}/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '{{ url('/dashboard') }}/laravel-filemanager/upload?type=Images&_token=' +
                    _token,
                filebrowserBrowseUrl: '{{ url('/dashboard') }}/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '{{ url('/dashboard') }}/laravel-filemanager/upload?type=Files&_token=' + _token,
            };

            //CKEDITOR.config.removeButtons = ['ImageButton', 'Image']; 
            CKEDITOR.replace('my-editor', options);

            //height ckeditor
            CKEDITOR.config.height = '400';

            //var route_prefix = '{{ url('/dashboard') }}/laravel-filemanager';
            var route_prefix = '{{ route('unisharp.lfm.show') }}';
            $('#lfm').filemanager('image', {
                prefix: route_prefix
            });

            $(document).ready(function() {
                previewImage();
            });

            function previewImage() {
                let path_image = $('#path_image').val();
                $('#preview_image').attr("src", path_image);
            }

        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.16/js/bootstrap-multiselect.min.js"
            integrity="sha512-ljeReA8Eplz6P7m1hwWa+XdPmhawNmo9I0/qyZANCCFvZ845anQE+35TuZl9+velym0TKanM2DXVLxSJLLpQWw=="
            crossorigin="anonymous"></script>

        <script>
            $(function() {
                $('#category_id').multiselect({
                    includeSelectAllOption: true,
                    selectAllText: ' Select all',
                    includeSelectAllIfMoreThan: 0,
                    selectAllText: ' Select all',
                    nonSelectedText: 'Trống',
                    selectAllJustVisible: true,
                    enableFiltering: true,
                    enableCaseInsensitiveFiltering: true,
                    enableFullValueFiltering: true,
                    buttonWidth: '100%',
                    dropRight: false,
                    dropUp: false,
                    buttonContainer: '<div class="btn-group" />',
                });
            });

        </script>

        <script>
            $(document).ready(function() {

                checkInputCheckedAll("indexAll");
                checkInputCheckedAll("index");
                checkInputCheckedAll("show");
                checkInputCheckedAll("create");
                checkInputCheckedAll("edit");
                checkInputCheckedAll("delete");
                checkInputCheckedAll("censor");
            });

            function checkBoxChecked(checkBoxTitle, checkBoxInput) {

                let title = $("#" + checkBoxInput + "Title");
                let input = $("input[name=\"" + checkBoxInput + "[]\"]");

                //Check vào tiêu đề
                if (title.prop("checked") == true) {
                    input.prop('checked', true);
                    calculateCountCheck(checkBoxInput, 0, input.length);
                } else {
                    input.prop('checked', false);
                    calculateCountCheck(checkBoxInput, 0, 0);
                }

            }

            function checkInputCheckedAll(nameCheckBox) {
                console.log("vao aaa");
                let input = $("input[name=\"" + nameCheckBox + "[]\"]");
                let title = $("#" + nameCheckBox + "Title");
                let checked = true;
                input.each(function(key) {
                    if ($(this).prop('checked') == false) {
                        checked = false;
                    }
                });

                if (checked == true) {
                    title.prop('checked', checked);
                } else {
                    title.prop('checked', false);
                }

            }

            function tickMenu(i) {
                if ($("#index_" + i).prop('checked') == true && $("#show_" + i).prop('checked') == true &&
                    $("#create_" + i).prop('checked') == true && $("#edit_" + i).prop('checked') == true &&
                    $("#delete_" + i).prop('checked') == true && $("#censor_" + i).prop('checked') == true &&
                    $('#indexAll_' + i).prop('checked') == true) {

                    $("#index_" + i).prop('checked', false);
                    $("#show_" + i).prop('checked', false);
                    $("#create_" + i).prop('checked', false);
                    $("#edit_" + i).prop('checked', false);
                    $("#delete_" + i).prop('checked', false);
                    $("#censor_" + i).prop('checked', false);
                    $("#indexAll_" + i).prop('checked', false);
                } else {
                    $("#index_" + i).prop('checked', true);
                    $("#show_" + i).prop('checked', true);
                    $("#create_" + i).prop('checked', true);
                    $("#edit_" + i).prop('checked', true);
                    $("#delete_" + i).prop('checked', true);
                    $("#censor_" + i).prop('checked', true);
                    $("#indexAll_" + i).prop('checked', true);
                }

                checkInputCheckedAll("index");
                checkInputCheckedAll("show");
                checkInputCheckedAll("create");
                checkInputCheckedAll("edit");
                checkInputCheckedAll("delete");
                checkInputCheckedAll("censor");
                checkInputCheckedAll("indexAll");
            }

        </script>

    @endpush
@endsection
