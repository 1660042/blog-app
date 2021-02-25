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
                    <div class="card-body">
                      <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                          <th class="text-center">ID</th>
                          <th class="text-center">Tên chuyên mục</th>
                          <th class="text-center">Chuyên mục cha</th>
                          <th class="text-center">Đường dẫn chuyên mục</th>
                          <th class="text-center">Trạng thái</th>
                          <th class="text-center">Tác vụ</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($categories as $cat)

                        <tr>
                          <td class="text-center">#{{ $cat->id }}</td>
                          <td class="text-center">{{ $cat->name }}</td>
                          <td class="text-center {{ ($cat->category == null ? "text-danger" : "") }}"> {{ ($cat->category == null ? "(Trống)" : $cat->category->name) }}</td>
                          <td class="text-center {{ ($cat->url_page == null ? "text-danger" : "") }}">{{ $cat->url_page == null ? "(Trống)" : $cat->url_page }}</td>
                          <td class="text-center {{ $cat->status == '1' ? "" : "text-danger" }}">{{ $status[$cat->status] }}</td>
                          <td class="text-center">
                             <div class="d-flex justify-content-around">
                                <!-- <div class="col-sm-6"> -->
                                <a href="{{ route('backend.posts.categories.edit', $cat->id) }}" class="btn btn-primary btn-sm" title="Sửa chuyên mục"><i class="far fa-edit" ></i>&ensp;Sửa</a>
                                <!-- </div>
                                <div class="col-sm-6"> -->
                                <a href="/" class="btn btn-danger btn-sm" title="Xóa chuyên mục"><i class="far fa-trash-alt"></i>&ensp;Xóa</a>
                                <!-- </div> -->
                            
                            </div> 
                          </td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Tên chuyên mục</th>
                            <th class="text-center">Chuyên mục cha</th>
                            <th class="text-center">Đường dẫn chuyên mục</th>
                            <th class="text-center">Trạng thái</th>
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
          </section>
          <!-- /.content -->
@endsection