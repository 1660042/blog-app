  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/summernote/summernote-bs4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/toastr/toastr.min.css') }}">


<!-- SweetAlert2 -->
<script src="{{ asset('AdminLTE-3.1.0/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('AdminLTE-3.1.0/plugins/toastr/toastr.min.js') }}"></script>

@if(session('message'))
<script>
    @if(session('type') == 'success')
        toastr.success('{{ session('message') }}')
    @elseif(session('type') == 'error')
        toastr.error('{{ session('message') }}')
    @endif
</script>

{{-- Dành cho login --}}
@elseif($errors->first('login'))
<script>
    toastr.error('{{ $errors->first('login') }}')
</script>

{{-- Các lỗi khác --}}
@elseif ($errors->any())
<script>
    toastr.error('Có lỗi xảy ra! Vui lòng kiểm tra lại!')
</script>
@endif