window.onscroll = function() {
    if (window.pageYOffset > 10) {
        document.getElementsByTagName("nav")[0].classList.add("scrollnav")
    } else if (window.pageYOffset < 10) {
        document.getElementsByTagName("nav")[0].classList.remove("scrollnav")
    }
}

// Form Submitting

$(".ajax-form").submit(function(e) {
    e.preventDefault()
    var formData = $(this).serialize()
    var interface = $(this).attr("data-interface");
    var thisForm = $(this);
    var nextStep = parseInt($(this).attr("data-step")) + 1;
    var nextForm = $(`form.ajax-form[data-step=${nextStep}]`);
    $.ajax({
        url : "/interface/" + interface,
        type: "POST",
        data : formData,
        success: function(response, textStatus, jqXHR) {
            console.log(response);
            thisForm.css("display", "none");
            nextForm.css("display", "unset");
            if (nextStep == 2) {
                nextForm.find("input#uuid-2").val(response.uuid)
                nextForm.find("input#subject").val(response.emailSubject)
                nextForm.find("textarea#email").val(response.emailContent)
            } if (nextStep == 3) {
                $("#thx-title").html(response.thxTitle)
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
              console.log(textStatus);
              console.log(errorThrown);
        }
    });
})