@extends('backend.layouts.default')
@section('title', 'Bài viết')
@section('content')
        <!-- Main content -->
       
        <section class="content">
            
            <div class="container-fluid">
            
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Danh sách bài viết</h3>
                      <div class="text-right">
                        <a class=" btn btn-primary btn-sm" href="{{ route("backend.posts.posts.index") }}"><i class="fas fa-file-alt"></i>&ensp;Tạo bài viết mới</a>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                          <th class="text-center">ID</th>
                          <th class="text-center">Tên bài viết</th>
                          <th class="text-center">Hình ảnh</th>
                          <th class="text-center">Đường dẫn</th>
                          <th class="text-center">Chuyên mục</th>
                          <th class="text-center">Trạng thái</th>
                          <th class="text-center">Người tạo</th>
                          <th class="text-center">Người sửa</th>
                          <th class="text-center">Tác vụ</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($posts as $post)

                         <tr>
                          <td class="text-center">#{{ $post->id }}</td>
                          <td class="text-center">{{ $post->name }}</td>
                          <td class="text-center">{{ $post->path_image }}</td>
                          <td class="text-center">{{ $post->slug }}</td>
                          <td class="text-center">{{ $post->getCategory->name }}</td>
                          <td class="text-center {{ $post->status == '1' ? "" : "text-danger" }}">{{ $status[$post->status] }}</td>
                          <td class="text-center">{{ $post->createBy == null ? "" : $post->createBy->name }}</td>
                          <td class="text-center">{{ $post->updateBy == null ? "" : $post->updateBy->name }}</td>
                          <td class="text-center">
                             <div class="d-flex justify-content-around">
                                <!-- <div class="col-sm-6"> -->
                                <a href="{{ route('backend.posts.categories.edit', $post->id) }}" class="btn btn-primary btn-sm" title="Sửa chuyên mục"><i class="far fa-edit" ></i>&ensp;Sửa</a>
                                <!-- </div>
                                <div class="col-sm-6"> -->
                                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-overlay-{{$post->id}}">
                                    <i class="far fa-trash-alt"></i>&ensp;Xóa
                                  </button>
                                  
                                {{-- <a href="/" class="btn btn-danger btn-sm" title="Xóa chuyên mục"><i class="far fa-trash-alt"></i>&ensp;Xóa</a> --}}
                                <!-- </div> -->
                            
                            </div> 
                          </td>
                        </tr> 
                        
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                          <th class="text-center">ID</th>
                          <th class="text-center">Tên bài viết</th>
                          <th class="text-center">Hình ảnh</th>
                          <th class="text-center">Đường dẫn</th>
                          <th class="text-center">Chuyên mục</th>
                          <th class="text-center">Trạng thái</th>
                          <th class="text-center">Người tạo</th>
                          <th class="text-center">Người sửa</th>
                          <th class="text-center">Tác vụ</th>
                        </tr>
                        </tfoot>
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
            @foreach ($posts as $post)
            <div class="modal fade" id="modal-overlay-{{$post->id}}">
              <div class="modal-dialog">
                <div class="modal-content" id="modal-content-{{ $post->id }}">
                  
                  <div class="modal-header">
                    <h4 class="modal-title">Thông báo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Bạn có chắc chắn xóa chuyên mục {{ $post->name }} ?</p>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                    <button type="button" onclick="deleteCategory({{ $post->id }})" class="btn btn-danger">Xóa</button>
                  </div>
                  <form id="form-delete-{{ $post->id }}" method="POST" action="{{ route('backend.posts.categories.delete', $post->id) }}">
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