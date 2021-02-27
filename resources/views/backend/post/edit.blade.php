@extends('backend.layouts.default')
@section('title', 'Viết bài mới')

@section('content')
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      @include('common.notification')
        <div class="row">
          <!-- left column -->
            <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Bài viết</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="form" method="POST" action="{{ route('backend.posts.posts.update', $post->id) }}">
					@csrf
                    @method('PUT')
                  <div class="card-body">
                    <div class="form-group">
                        @if ($errors->first('name'))
                        <label class="text-danger">{{ $errors->first('name') }}</label></br>
                        @endif
                        <label for="">Tên bài viết</label>
                        <input type="text" class="form-control" id="name" value="{{ $post->name }}" name="name" onkeyup="getSlug()" onchange="getSlug()" placeholder="Nhập tên bài viết">
                    </div>
                    <div class="form-group">
                        @if ($errors->first('path_image'))
                        <label class="text-danger">{{ $errors->first('path_image') }}</label></br>
                        @endif
                        <label for="">Chọn ảnh đại diện bài viết</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="path_image" data-preview="holder" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Chọn ảnh
                                </a>
                            </span>
                            <input id="path_image" onchange="previewImage()" class="form-control" value="{{ $post->path_image }}" readonly placeholder="Đường dẫn hình ảnh" type="text" name="path_image">
                            
                        </div>
                        <div class="image_preview d-flex justify-content-center">
                            <img id="preview_image" style="margin-top:15px;max-height:200px;">
                        </div>
                        
                    </div>
                    <div class="form-group">
                        @if ($errors->first('slug'))
                            <label class="text-danger">{{ $errors->first('slug') }}</label></br>
                        @endif
                    
                      <label for="">Đường dẫn bài viết</label>
                      <input type="text" class="form-control" value="{{ $post->slug }}" id="slug" name="slug" placeholder="Nhập đường dẫn">
                    </div>
                    <div class="form-group">
                        @if ($errors->first('content'))
                        <label class="text-danger">{{ $errors->first('content') }}</label></br>
                        @endif
                          <label for="">Nội dung</label>
                          <textarea class="form-control" id="my-editor" rows="3" name='content'>{{ $post->content }}</textarea>
                    </div>
                    <div class="form-group">
                        @if ($errors->first('category_id'))
                        <label class="text-danger">{{ $errors->first('category_id') }}</label></br>
                        @endif
                        <label for="category_id">Chuyên mục</label>
                        <select class="custom-select rounded-0" id="category_id" name="category_id">
                            <option value="">Trống</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $post->category_id == $cat->id ? "selected" : "" }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
					<div class="form-group">
                    @if ($errors->first('status'))
                    <label class="text-danger">{{ $errors->first('status') }}</label></br>
                    @endif
                        <div class="custom-control custom-checkbox">
							<input class="custom-control-input" value="1" {{ $post->status == '1' ? 'checked' : "" }} name="status" type="checkbox" id="customCheckbox1" checked>
							<label for="customCheckbox1" class="custom-control-label">Hoạt động</label>
						</div>
						
                    </div>
                    
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
		var _token =  $('input[name="_token"]').val();
			//console.log(token);
		$.ajax({
			type: 'POST', //THIS NEEDS TO BE GET
			url: "{{ route('backend.ajax.slug') }}",
			//dataType: 'json',
			data: {
				"_token" : _token,
				"name" : $('#name').val(),
			},
			// beforeSend: function(xhr) {
			// 	xhr.setRequestHeader('x-csrf-token', _token);
			// },
			success: function (data) {
                $('#slug').val(data);
				//console.log("thành công: " + data);
			},
			error:function(data, xhr){ 
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
        var _token =  $('input[name="_token"]').val();
        //alert(_token);
        var options = {
            filebrowserImageBrowseUrl: '{{ url('/dashboard') }}/laravel-filemanager?type=Images',
            filebrowserFlashUploadUrl: '{{ url('/dashboard') }}/laravel-filemanager/upload?type=Files&_token='+_token,
            filebrowserFlashBrowseUrl: '{{ url('/dashboard') }}/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '{{ url('/dashboard') }}/laravel-filemanager/upload?type=Images&_token='+_token,
            filebrowserBrowseUrl: '{{ url('/dashboard') }}/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '{{ url('/dashboard') }}/laravel-filemanager/upload?type=Files&_token='+_token,
        };

        //CKEDITOR.config.removeButtons = ['ImageButton', 'Image']; 
        CKEDITOR.replace('my-editor', options); 
    
        //height ckeditor
        CKEDITOR.config.height = '400';
        
        //var route_prefix = '{{ url('/dashboard') }}/laravel-filemanager';
        let route_prefix = '{{ route('unisharp.lfm.show') }}';
        $('#lfm').filemanager('image', {prefix: route_prefix});
        
        
        $( document ).ready(function() {
            previewImage();
        });

        function previewImage() {
            let path_image = $('#path_image').val();
            $('#preview_image').attr("src", path_image);
        }

    </script>

    @endpush
@endsection