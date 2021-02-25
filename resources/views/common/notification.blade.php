@if(session('message'))
<script>
@if(session('type') == 'success')
toastr.success('{{ session('message') }}')
@elseif(session('type') == 'danger')
toastr.danger('{{ session('message') }}')
@endif
</script>
@endif
