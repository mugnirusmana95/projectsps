<script type="text/javascript">
  $(document).ready(function(){
    $("#source").change(function(){
      var val = $(this).val();
      $.get('/beasiswa/bpp/'+val,function(response){
        $("#bpp").val(response.bpp.bpp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
      });
    });

    var bpp = document.getElementById('bpp');
    bpp.addEventListener('keyup', function(e)
    {
      bpp.value = formatRupiah(this.value);
    });

    function formatRupiah(angka, prefix)
    {
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split	= number_string.split(','),
        sisa 	= split[0].length % 3,
        rupiah 	= split[0].substr(0, sisa),
        ribuan 	= split[0].substr(sisa).match(/\d{3}/gi);

      if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
  });
</script>
