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
                        <form id="form" method="POST" action="{{ route('backend.posts.posts.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    @if ($errors->first('name'))
                                        <label class="text-danger">{{ $errors->first('name') }}</label></br>
                                    @endif
                                    <label for="">Tên quyền</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Nhập tên quyền">
                                </div>
                                <div class="form-group">
                                    @if ($errors->first('description'))
                                        <label class="text-danger">{{ $errors->first('description') }}</label></br>
                                    @endif
                                    <label for="">Mô tả</label>
                                    <input type="text" class="form-control" id="description" name="description"
                                        placeholder="Nhập mô tả">
                                </div>

                                <div class="form-group">
                                    @if ($errors->first('status'))
                                        <label class="text-danger">{{ $errors->first('status') }}</label></br>
                                    @endif
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" value="1" name="status" type="checkbox"
                                            id="customCheckbox1" checked>
                                        <label for="customCheckbox1" class="custom-control-label">Hoạt động</label>
                                    </div>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">Ứng dụng</th>
                                            <th>
                                                Ứng dụng con
                                            </th>
                                            <th>
                                                <div class="custom-control custom-checkbox">

                                                    <input class="custom-control-input" value="1" name="indexTitle"
                                                        type="checkbox" id="indexTitle">
                                                    <label for="indexTitle" class="custom-control-label">Hiển thị</label>
                                                </div>
                                            </th>
                                            <th>
                                                <div class="custom-control custom-checkbox">

                                                    <input class="custom-control-input" value="1" name="showTitle"
                                                        type="checkbox" id="showTitle">
                                                    <label for="showTitle" class="custom-control-label">Xem</label>
                                                </div>
                                            </th>
                                            <th>
                                                <div class="custom-control custom-checkbox">

                                                    <input class="custom-control-input" value="1" name="createTitle"
                                                        type="checkbox" id="createTitle">
                                                    <label for="createTitle" class="custom-control-label">Tạo</label>
                                                </div>
                                            </th>
                                            <th>
                                                <div class="custom-control custom-checkbox">

                                                    <input class="custom-control-input" value="1" name="editTitle"
                                                        type="checkbox" id="editTitle">
                                                    <label for="editTitle" class="custom-control-label">Sửa</label>
                                                </div>
                                            </th>
                                            <th>
                                                <div class="custom-control custom-checkbox">

                                                    <input class="custom-control-input" value="1" name="deleteTitle"
                                                        type="checkbox" id="deleteTitle">
                                                    <label for="deleteTitle" class="custom-control-label">Xóa</label>
                                                </div>
                                            </th>
                                            <th>
                                                <div class="custom-control custom-checkbox">

                                                    <input class="custom-control-input" value="1" name="censorTitle"
                                                        type="checkbox" id="censorTitle">
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
                                                        rowspan="{{ $menu->getParentMenu->getChildMenus->where('status', '=', '1')->count() }}">
                                                        {{ $menu->getParentMenu->name }}</td>
                                                @endif

                                                @php
                                                    $menuTemp = $menu->getParentMenu->id;
                                                @endphp
                                                <td>
                                                    {{ $menu->name }}
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" value="1" name="index[]"
                                                            type="checkbox" id="index_{{ $i }}">
                                                        <label for="index_{{ $i }}"
                                                            class="custom-control-label"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" value="1" name="show[]"
                                                            type="checkbox" id="show_{{ $i }}">
                                                        <label for="show_{{ $i }}"
                                                            class="custom-control-label"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" value="1" name="create[]"
                                                            type="checkbox" id="create_{{ $i }}">
                                                        <label for="create_{{ $i }}"
                                                            class="custom-control-label"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" value="1" name="update[]"
                                                            type="checkbox" id="update_{{ $i }}">
                                                        <label for="update_{{ $i }}"
                                                            class="custom-control-label"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" value="1" name="delete[]"
                                                            type="checkbox" id="delete_{{ $i }}">
                                                        <label for="delete_{{ $i }}"
                                                            class="custom-control-label"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" value="1" name="censor[]"
                                                            type="checkbox" id="censor_{{ $i }}">
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
                                <a href="{{ route('backend.posts.posts.index') }}" class="btn btn-dark mr-2">Quay lại</a>
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
                        $("#indexTitle").click(function() {
                            if ($('#indexTitle').prop("checked") == true) {
                                $('input[name="index[]"]').prop('checked', true);
                            } else {
                                $('input[name="index[]"]').prop('checked', false);
                            }
                        });
                        $('input[name="index[]"]').change(function() {
                                if (this.checked == false) {

                                    $('#indexTitle').prop('checked', this.checked);
                                } else {

                                });
                        });

        </script>

    @endpush
@endsection
