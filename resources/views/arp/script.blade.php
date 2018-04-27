<script type="text/javascript">
$(document).ready(function(){

  //Jika Termin dipilih
  $("#invoice").change(function(){
    $("#dis").removeClass('hide');
    var val = $(this).val();

    //Menampilkan total dari termin
    $.get( "/pembayaran/tagihan/search/"+val, function( value ) {
      $('#termin').val(value.tagihan.termin)
      $('#tgl_tagihan').val(value.tagihan.date)
      $('#tgl_tempo').val(value.tagihan.date_end)
      $('#tagihan').val(value.total.tagihan.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
      $('#pengelolaan').val(value.total.pengelolaan.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
      $('#bpp').val(value.total.bpp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
    });

    $.get( "/pembayaran/id/search/"+val, function( value2 ) {
      $('#sp2d').val(value2)
    });

    var bpp = document.getElementById('bpp');
    bpp.addEventListener('keyup', function(e)
    {
      bpp.value = formatRupiah(this.value);
    });

    var tagihan = document.getElementById('tagihan');
    tagihan.addEventListener('keyup', function(e)
    {
      tagihan.value = formatRupiah(this.value);
    });

    var pengelolaan = document.getElementById('pengelolaan');
    pengelolaan.addEventListener('keyup', function(e)
    {
      pengelolaan.value = formatRupiah(this.value);
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

});
</script>
