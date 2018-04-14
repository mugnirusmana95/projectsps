<script type="text/javascript">
$(document).ready(function(){

  $('.fakultas-invalid').hide();
  $('.prodi-invalid').hide();

  $("#fakultas").change(function(){
    var val = $(this).val();
    $('#prodi').html('');

    if (val==='0') {
      $('.fakultas-invalid').show();
      $('#prodi').append('<option value="0">Lainnya (Tambah)</option>');
      $('.prodi-invalid').show();

    } else {
      $('.fakultas-invalid').hide();
      $('.prodi-invalid').hide();


      $.get("/master/program_studi/search/"+val, function(response){
          $.each(response, function (index, value) {
            console.log(value.name);
            $('#prodi').append('<option value="'+value.name+'">'+value.name+'</option>')
          });
          $('#prodi').append('<option value="0">Lainnya (Tambah)</option>');
      });

    }

  });

  $("#prodi").change(function(){
    var val = $(this).val();

    if (val==='0') {
      $('.prodi-invalid').show();
    } else {
      $('.prodi-invalid').hide();
    }
  });

  $("#delete").click(function(){
    swal("Test sweet alert");
  });

});
</script>
