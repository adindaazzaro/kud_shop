$('.btn-add-multiple-input').click(function (e) { 
    e.preventDefault();
    var html = '<div class="input-group mb-3">\
                        <input type="text" name="vidio[]" class="form-control" placeholder="Masukkan Kode Vidio Youtube disini">\
                        <div class="input-group-append">\
                            <button type="button" name="vidio[]" class="btn btn-danger btn-remove-multiple-input"><i class="fas fa-times-circle"></i></button>\
                        </div>\
                    </div>';
    $(".data").append(html);
});
$(document).on('click','.btn-remove-multiple-input',function () {
    $(this).closest('.input-group').remove();
});