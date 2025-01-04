$(".show-more").click(function () {
    if ($(".text").hasClass("show-more-height")) {
        $(this).text("Tutup Text");
    } else {
        $(this).text("Baca Selengkapnya");
    }

    $(".text").toggleClass("show-more-height");
});

$(document).ready(function () {
    $(".catatan").click(function () {
        $('.tampil').removeClass('d-none');
        $('#buka-catatan').addClass('d-none');
    });

    $("#batal").click(function () {
        $('.tampil').addClass('d-none');
        $('#isi-catatan').val(null);
        $('#buka-catatan').removeClass('d-none');
    });
});

function calculate() {
    var quantity = parseInt($(":input[name='jumlah']").val());
    if (quantity < 1) {
        beep();
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Tidak Boleh Minus',
        });
        $(":input[name='jumlah']").val('1');
        $("#td-jumlah").text('1 Item');
        $("#total_jumlah").val('1');
    } else {
        beep();
        var val2 = $('#subtotal').val();
        var total = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumSignificantDigits: 3 }).format(val2 * quantity);
        // $('#sub-text').html(total);
        $('#total-text').html(total + ' / ' + quantity + ' Item');
        $("#td-jumlah").text(quantity + ' Item');
        $("#total_jumlah").val(quantity);
    }
}

function changeQuantity(num) {
    $(":input[name='jumlah']").val(parseInt($(":input[name='jumlah']").val()) + num);
}

$(document).ready(function () {
    calculate();
    $(".kurang").click(function () {
        changeQuantity(-1);
        calculate();
    });
    $(".tambah").click(function () {
        changeQuantity(1);
        calculate();
    });

    $(":input[name='jumlah']").keyup(function (e) {
        if (e.keyCode == 38) changeQuantity(1);
        if (e.keyCode == 40) changeQuantity(-1);
        calculate();
    });

    var quantity = document.getElementById("quantity");
    quantity.addEventListener("input", function (e) {
        calculate();
    });

});

$(document).ready(function () {
    $("textarea#isi-catatan").keyup(function () {
        $("#td-catatan").text($(this).val());
        $("#catatan").val($(this).val());
    });

    $('#td-jumlah').text($("input[name='jumlah']").val() + ' Item');
});