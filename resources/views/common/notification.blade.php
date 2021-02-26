@if(session('message'))
<script>
@if(session('type') == 'success')
toastr.success('{{ session('message') }}')
@elseif(session('type') == 'error')
toastr.error('{{ session('message') }}')
@endif
</script>
@endif
