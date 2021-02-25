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
                <form id="form">
					@csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="">Tên chuyên mục</label>
                      <input type="text" class="form-control" id="name" name="name" onchange="aaa()" placeholder="Nhập tên chuyên mục">
                    </div>
                    <div class="form-group">
                      <label for="">Đường dẫn chuyên mục</label>
                      <input type="text" class="form-control" id="url_page" name="url_page" placeholder="Nhập đường dẫn chuyên mục">
                    </div>
                    <div class="form-group">
                        <label for="parent_id">Chuyên mục cha</label>
                        <select class="custom-select rounded-0" id="parent_id" name="parent_id">
                            <option>Chọn chuyên mục cha</option>
                            <option>Value 1</option>
                            <option>Value 2</option>
                            <option>Value 3</option>
                        </select>
                    </div>
					<div class="form-group">
                        <div class="custom-control custom-checkbox">
							<input class="custom-control-input" type="checkbox" id="customCheckbox1" checked>
							<label for="customCheckbox1" class="custom-control-label">Hoạt động</label>
						</div>
						
                    </div>
                    
                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Tạo chuyên mục</button>
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
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script>
		console.log($('#name').val());
		
		function aaa() {
			var token =  $('input[name="_token"]').val();
			//console.log(token);
			$.ajax({
				type: 'POST', //THIS NEEDS TO BE GET
				url: "{{ route('backend.ajax.slug') }}",
				dataType: 'json',
				data: {
					//"_token" : {{ csrf_token() }},
					"name" : $('#name').val(),
				},
				beforeSend: function(xhr) {
					xhr.setRequestHeader('x-csrf-token', token);
				},
				success: function (data) {
					console.log("thành công: ");
				},
				error:function(data, xhr){ 
					console.log("thất bại");
					console.log(xhr.status);
        			//console.log(thrownError);
				}
    		});
		}
	</script>
	@endpush
	
@endsection