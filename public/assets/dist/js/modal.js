function makeModalForm(form,id_modal){
    var html = '<div id="'+id_modal+'" class="modal" tabindex="-1">\
        <div class="modal-dialog">\
            <div class="modal-content">\
            <div class="modal-header">\
                <h5 class="modal-title">-</h5>\
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">\
                <span aria-hidden="true">&times;</span>\
                </button>\
            </div>\
            <div class="modal-body position-relative">\
                <div class="loading-form">'+buildLoadingForm()+'</div>\
                <form action="" id="form-data">\
                    '+form+'\
                </form>\
            </div>\
            <div class="modal-footer">\
                <button id="btn-submit" type="button" class="btn btn-primary">Simpan</button>\
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>\
            </div>\
            </div>\
        </div>\
        </div>';
    $("body").append(html);
    // $("#target-modal").remove();
}