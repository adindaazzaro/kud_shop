// submit data
function saveForm(form,url,modal,statusSubmit,method = "post",igoneinput = [], withFile = false){
    
    var result = false;
    var validate = false;
    var msg = null;
    var data = null;
    validate = validateInput(form,igoneinput);
    if(statusSubmit == 1){//new
        msg = 'Menambahkan';
    }else if(statusSubmit == 2){//update
        msg = 'Mengubah';
    }

    if(withFile){
        data = new FormData(form[0]);
    }else{
        console.log("bukan file");
        data = form.serialize()+ '&_method=' + method;
    }
    if(validate){
        $("#btn-submit").attr('disabled','disabled');
        loadingFormStart();
        var option = {
            type: method,
            url: url,
            data: data,
            dataType: "JSON",
            success: function (response) {
                modal.modal('hide');
                $('#data').DataTable().destroy();
                setDataTable();
                iziToast.success({
                    title: 'Success',
                    message: 'Success '+msg+' data',
                    position: 'topRight'
                });
                result = true;
                $("#btn-submit").removeAttr('disabled');
                loadingFormStop();
            }
        }
        if(withFile){
            option.processData = false
            option.contentType = false
        }
        $.ajax(option);
    }
    return result;
}