$(document).on('click','.delete',function(e){
        e.preventDefault();
        Swal.fire({
            title: 'Kamu Yakin?',
            text: "Menghapus data ini",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
            }).then((result) => {
            if (result.isConfirmed) {
                deleteData($(this).attr('href'),'post',{_method:'delete'});
            }
        })
    
});
function deleteData(url,type = "get",method = null){
    $(".progress").show();
    $("#progress").css("width","50%")
    $.ajax({
        type: type,
        url: url,
        data : method,
        dataType: "JSON",
        xhr: function() {
            var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                       
                        var percentComplete = (evt.loaded / evt.total) * 100;
                        if(percentComplete == 100){
                            $("#progress").css("width",percentComplete+"%")
                            $(".progress").hide();
                        }
                        //Do something with upload progress here
                    }
                    
            }, false);
        return xhr;
        },
        success: function (response) {
            if(response.status){
                iziToast.success({
                    title: 'Success',
                    message: response.msg,
                    position: 'topRight'
                });
                $('#data').DataTable().ajax.reload();
                $("#progress").css("width","0%")
                // setDataTable();
            }
        }
    });
}