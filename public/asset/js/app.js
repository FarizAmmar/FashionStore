// Format nomer telp
$('#phone').on('input', function() {
    var phoneRegex = /^(?:\+62|62|0)[2-9]{1}[0-9]+$/; // regex untuk nomor telepon Indonesia atau +62
    var input = $(this).val().replace(/\D/g,'').substring(0,12); // hapus karakter selain angka dan batasi panjang maksimal input hingga 12 karakter
    input = input.replace(/\B(?=(\d{4})+(?!\d))/g, '-'); // tambahkan tanda hubung (-) setiap 4 digit

    $(this).val(input); // terapkan input yang sudah diubah

    if (input.length < 11) {
      $(this).addClass('is-invalid');
    } else {
      $(this).removeClass('is-invalid');
    }
  });


// format postcode
  $(document).ready(function() {
    $("#postcode").on("input", function() {
      var postcode = $(this).val();
      var regex = /^[0-9]*$/; // regex untuk karakter angka saja
      if(!regex.test(postcode)) {
        $(this).val(postcode.replace(/[^0-9]/g,'')); // menghapus karakter selain angka
      }
    });
  });


  const form = document.getElementById('delete-form');
    form.addEventListener('submit', (event) => {
        if (!confirm('Are you sure you want to delete this product?')) {
            event.preventDefault();
        }
    });
