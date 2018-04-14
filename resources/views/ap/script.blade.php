<script type="text/javascript">
$(document).ready(function(){

  $("#bpp").change(function(){
    $("#itb").val($("#bpp").val());
  });

  //Jika Termin dipilih
  $("#payment").change(function(){
    $("#dis").removeClass('hide');
    var val = $(this).val();

    //Menampilkan total dari termin
    $.get( "/penagihan/total/search/"+val, function( value ) {
      $('#invoice').val(value.tagihan.invoice)
      $('#termin').val(value.arp.termin)
      $('#tgl_tagihan').val(value.arp.date)
      $('#tgl_tempo').val(value.arp.date_end)
      $('#tagihan').val(value.arp.tagihan.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
      $('#pengelolaan').val(value.arp.pengelolaan.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
      $('#bpp').val(value.bpp.bpp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
      $('#itb').val($('#bpp').val())
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

    var itb = document.getElementById('itb');
    itb.addEventListener('keyup', function(e)
    {
      itb.value = formatRupiah(this.value);
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
