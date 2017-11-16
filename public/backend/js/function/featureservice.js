function countFeatures() {
    var features = document.getElementsByClassName("feature");
    var checks = 0;
    for (i = 0; i < features.length; i++){
        if (features[i].checked == true){
            checks += 1;
        }
    }
    return checks;
}

function ajaxCheck(id, route){
    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'post',
        cache: false,
        data: {
            'id': id
        },
        success: function (data) {

        },
        error: function () {
            alert("error");
        }
    });
}

function feature(id, route) {
    var feature = document.getElementById("feature_" + id);
    if(feature.checked){
        if(countFeatures() > 4){
            alert("Maximum number of feature services is 4");
            feature.checked = false;
        } else {
            ajaxCheck(id, route);
        }
    } else {
        ajaxCheck(id, route);
    }
}