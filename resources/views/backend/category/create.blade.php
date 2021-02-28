@extends('backend.layouts.default')
@section('title', 'Tạo chuyên mục')

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
                  <h3 class="card-title">Chuyên mục</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="form" method="POST" action="{{ route('backend.posts.categories.store') }}">
					@csrf
                  <div class="card-body">
                    <div class="form-group">
                        <label class="text-danger">{{ $errors->first('name') }}</label></br>
                      <label for="">Tên chuyên mục</label>
                      <input type="text" class="form-control" id="name" name="name" onkeyup="getSlug()" onchange="getSlug()" placeholder="Nhập tên chuyên mục">
                    </div>
                    
                    <div class="form-group">
                    <label class="text-danger">{{ $errors->first('url_page') }}</label></br>
                      <label for="">Đường dẫn chuyên mục</label>
                      <input type="text" class="form-control" id="url_page" name="url_page" placeholder="Nhập đường dẫn chuyên mục">
                    </div>
                    <div class="form-group">
                    <label class="text-danger">{{ $errors->first('parent_id') }}</label></br>
                        <label for="parent_id">Chuyên mục cha</label>
                        <select class="custom-select rounded-0" id="parent_id" name="parent_id">
                            <option value="">Trống</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
					<div class="form-group">
                    <label class="text-danger">{{ $errors->first('status') }}</label></br>
                        <div class="custom-control custom-checkbox">
							<input class="custom-control-input" value="1" name="status" type="checkbox" id="customCheckbox1" checked>
							<label for="customCheckbox1" class="custom-control-label">Hoạt động</label>
						</div>
						
                    </div>
                    
                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer d-flex justify-content-start">
                    <a href="{{ route('backend.posts.categories.index') }}" class="btn btn-dark mr-2">Quay lại</a>
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
                $('#url_page').val(data);
				//console.log("thành công: " + data);
			},
			error:function(data, xhr){ 
				 console.log("thất bại");
			}
    	});
	}
	</script>
	@endpush
	
@endsection