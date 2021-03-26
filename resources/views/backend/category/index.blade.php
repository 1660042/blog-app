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
                      <h3 class="card-title">Danh sách chuyên mục</h3>
                      <div class="text-right">
                        <a class=" btn btn-primary btn-sm" href="{{ route("backend.posts.categories.create") }}"><i class="fas fa-folder-plus"></i>&ensp;Tạo chuyên mục mới</a>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: auto;">
                        <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                          <th class="text-center align-middle">#ID</th>
                          <th class="text-center align-middle">Tên chuyên mục</th>
                          <th class="text-center align-middle">Chuyên mục cha</th>
                          <th class="text-center align-middle">Đường dẫn chuyên mục</th>
                          <th class="text-center align-middle">Trạng thái</th>
                          <th class="text-center align-middle">Người tạo</th>
                          <th class="text-center align-middle">Người sửa</th>
                          <th class="text-center align-middle">Tác vụ</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($categories as $cat)

                        <tr>
                          <td class="text-center align-middle">#{{ $cat->id }}</td>
                          <td class="text-center align-middle">{{ $cat->name }}</td>
                          <td class="text-center align-middle {{ ($cat->category == null ? "text-danger" : "") }}"> {{ ($cat->category == null ? "(Trống)" : $cat->category->name) }}</td>
                          <td class="text-center align-middle {{ ($cat->name_route == null ? "text-danger" : "") }}">{{ $cat->name_route == null ? "(Trống)" : $cat->name_route }}</td>
                          <td class="text-center align-middle {{ $cat->status == '1' ? "" : "text-danger" }}">{{ $status[$cat->status] }}</td>
                          <td class="text-center align-middle">{{ $cat->createdBy == null ? "" : $cat->createdBy->name }}</td>
                          <td class="text-center align-middle">{{ $cat->updatedBy == null ? "" : $cat->updatedBy->name }}</td>
                          <td class="text-center align-middle">
                             <div class="">
                                <!-- <div class="col-sm-6"> -->
                                <a href="{{ route('backend.posts.categories.edit', $cat->id) }}" class="btn btn-primary btn-sm" title="Sửa chuyên mục"><i class="far fa-edit" ></i>&ensp;Sửa</a>
                                <!-- </div>
                                <div class="col-sm-6"> -->
                                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-overlay-{{$cat->id}}">
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
            @foreach ($categories as $cat)
            <div class="modal fade" id="modal-overlay-{{$cat->id}}">
              <div class="modal-dialog">
                <div class="modal-content" id="modal-content-{{ $cat->id }}">
                  
                  <div class="modal-header">
                    <h4 class="modal-title">Thông báo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Bạn có chắc chắn xóa chuyên mục {{ $cat->name }} ?</p>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                    <button onclick="deleteCategory({{ $cat->id }})" class="btn btn-danger">Xóa</button>
                  </div>
                  <form id="form-delete-{{ $cat->id }}" method="POST" action="{{ route('backend.posts.categories.delete', $cat->id) }}">
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
    $('#modal-content-' + id).append("<div class=\"overlay d-flex justify-content-center align-items-center\"><i class=\"fas fa-2x fa-sync fa-spin\"></i></div>")
    $('#form-delete-'+id).submit();
  }
</script>
@endpush
@endsection