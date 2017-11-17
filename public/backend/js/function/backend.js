function viewAvatar(img) {
    var fileReader = new FileReader;
    fileReader.onload = function(img) {
        var avartarShow = document.getElementById("avartar-img-show");

        avartarShow.src = img.target.result
    }, fileReader.readAsDataURL(img.files[0])
}
function viewImg(img) {
    console.log(img);
    var fileReader = new FileReader;
    fileReader.onload = function(img) {
        console.log(img);
        var avartarShow = document.getElementById("indexImage-show");
        avartarShow.src = img.target.result
    }, fileReader.readAsDataURL(img.files[0]);

}

function uploadMedia() {
    var fakePath = $('#video').val();
    var arr_path = fakePath.split('/');
    var filename = arr_path[arr_path.length - 1];
    var filename = filename.split('.');
    var type = filename[filename.length - 1];
    if(type == 'mp4' || type == '3gp' || type == 'mov' || type =='avi'){
        $('#upload-file').submit();
    }else{
        alert('The format is invalid (mp4, 3gp, mov, avi)!');
    }
}
function uploadPhoto() {
    var fakePath = $('#image').val();
    var arr_path = fakePath.split('/');
    var filename = arr_path[arr_path.length - 1];
    var filename = filename.split('.');
    var type = filename[filename.length - 1];
    if(type == 'jpg' || type == 'png' || type == 'jpeg' || type =='gif'){
    }else{
        alert('The format is invalid (jpg, png, jpeg, gif)!');
    }
}
function viewImage(img) {
    uploadPhoto();
    var fileReader = new FileReader;
    fileReader.onload = function(img) {
        var avartarShow = document.getElementById("image-show");

        avartarShow.src = img.target.result
    }, fileReader.readAsDataURL(img.files[0])
}
function replyContact(id, type){
    if(confirm("You replied this contact?")){
        $.ajax({
            url: "/admin/replyContact",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'post',
            cache: false,
            data: {
                'id': id,
                'type' : type
            },
            success: function (data) {
                if(data === 'index'){
                    $('.reply_'+id).html('<span class="btn btn-success reply">REPLIED</span>');
                }else{
                    location.reload();
                }
            },
            error: function () {
                alert("error");
            }
        });
    }
}