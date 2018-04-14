<script type="text/javascript">
$(document).ready(function(){

  //Jika SPK dipilih
  $("#spk").change(function(){
    $("#dis").addClass('hide');
    var val = $(this).val();

    //Menampilkan termin dari SPK
    $.get("/tagihan/termin/search/"+val, function(response){
      $('#termin').html('')
      $('#total').val('')
      $('#biaya').val('')
      $('#tgl').val('')
      $('#tempo').val('')
      $('#termin').append('<option></option>')
      $.each(response, function (index, value) {
        console.log(response);
        $('#termin').append('<option value="'+value.id+'">'+value.name+'</option>')
      });
    });

    $.get("/tagihan/invoice/search/"+val, function(response2){
      $('#invoice').val(response2)
    });

  });

  //Jika Termin dipilih
  $("#termin").change(function(){
    $("#dis").removeClass('hide');
    var val2 = $(this).val();

    //Menampilkan total dari termin
    $.get( "/tagihan/total/search/"+val2, function( value ) {
      $('#termin2').val(value.tagihan.name)
      $('#termin3').val(value.tagihan.id)
      $('#tagihan').val(value.tagihan.bpp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
      $('#pengelolaan').val(value.tagihan.pengelolaan.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
      $('#tgl').val(value.tagihan.date)
      $('#tempo').val(value.tagihan.date_end)
      $('#bpp').val(value.bpp.bpp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
    });
    var pengelolaan = document.getElementById('pengelolaan');
    pengelolaan.addEventListener('keyup', function(e)
    {
      pengelolaan.value = formatRupiah(this.value);
    });

    var tagihan = document.getElementById('tagihan');
    tagihan.addEventListener('keyup', function(e)
    {
      tagihan.value = formatRupiah(this.value);
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

});
</script>
