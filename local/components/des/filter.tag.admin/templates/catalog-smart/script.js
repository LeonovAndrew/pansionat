$(document).on("click", ".filter-head", function () {
    $(this).parent().toggleClass("active");
});
$(document).on("keyup", ".filter_tag_admin input", function () {
    $("body").css("opacity", ".1");
    let val = $(".filter_tag_admin input").serializeArray();
    let valSreal = "";
    let formData = [];
    let strFormData = "";
    var iCount = 1;
    $.each(val, function(key, value){
        if (value.value) {
            var key = value.name.replaceAll("seoTagFilter", 'arrFilter');
            formData[key] = value.value;
            var and = "&"
            if (iCount === 1) {
                and = ""
            }
            strFormData = strFormData + and + key + "=" + value.value
            valSreal = valSreal + and + value.name + "=" + value.value
            iCount = iCount + 1;
        }
    });


    let idProp = $(".filter_tag_admin").data("id");
    let filterSmart = $("#filterSmart").data("id");

    let url = $("#sectionUrl").text();
    url = url + "?ajax=y"
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'json',
        data: strFormData,
        success: function(data){
            console.log(data.SEF_SET_FILTER_URL);
            $("#tr_PROPERTY_" + filterSmart + " input").val(data.SEF_SET_FILTER_URL);
            $("body").css("opacity", "1");
        }
    });
    $("#tr_PROPERTY_" + idProp + " input").val(valSreal);

});

$(document).on("click", ".filter_tag_admin input", function () {
    $("body").css("opacity", ".5");
    let val = $(".filter_tag_admin input").serializeArray();
    let valSreal = "";
    let formData = [];
    let strFormData = "";
    var iCount = 1;
    $.each(val, function(key, value){
        if (value.value) {
            var key = value.name.replaceAll("seoTagFilter", 'arrFilter');
            formData[key] = value.value;
            var and = "&"
            if (iCount === 1) {
                and = ""
            }
            strFormData = strFormData + and + key + "=" + value.value
            valSreal = valSreal + and + value.name + "=" + value.value
            iCount = iCount + 1;
        }
    });


    let idProp = $(".filter_tag_admin").data("id");
    let filterSmart = $("#filterSmart").data("id");

    let url = $("#sectionUrl").text();
     url = url + "?ajax=y"

    $.ajax({
        url: url,
        method: 'post',
        dataType: 'json',
        data: strFormData,
        success: function(data){
            $("#tr_PROPERTY_" + filterSmart + " input").val(data.SEF_SET_FILTER_URL);
            $("body").css("opacity", "1");
        }
    });
    $("#tr_PROPERTY_" + idProp + " input").val(valSreal);

});
