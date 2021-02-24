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
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                          <th class="text-center">ID</th>
                          <th>Tên chuyên mục</th>
                          <th>Chuyên mục cha</th>
                          <th>Đường dẫn chuyên mục</th>
                          <th>Tác vụ</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($categories as $cat)

                        <tr>
                          <td class="text-center">#{{ $cat->id }}</td>
                          <td>{{ $cat->name }}</td>
                          <td> {{ $cat->parent_id }}</td>
                          <td>{{ $cat->url_page }}</td>
                          <td></td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Tên chuyên mục</th>
                            <th>Chuyên mục cha</th>
                            <th>Đường dẫn chuyên mục</th>
                            <th>Tác vụ</th>
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