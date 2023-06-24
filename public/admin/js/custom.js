$(document).ready(function() {

    // DATE PICKER JS
    $('.date-picker').datepicker();

    // DATATABLES JS
    $('#user-table').DataTable();

    // MULTI-SELECT
    $('.multi-select').multiselect({
        selectAllValue: 'multiselect-all',
    });

    // function generateNotification(messageType, message, _url) {
    //     if (!_url) {
    //         _url = '';
    //     }
    //     var iconUse = '';
    //     if (messageType == 'danger') {
    //         iconUse = 'fa fa-exclamation-triangle';
    //     } else if (messageType == 'success' || messageType == 1) {
    //         iconUse = 'fa fa-check';
    //         messageType = 'success';
    //     } else if (messageType == 'info') {
    //         iconUse = 'fa fa-info-circle';
    //     } else if (messageType == 'error' || messageType == 0) {
    //         messageType = 'danger'
    //         iconUse = 'fa fa-exclamation-triangle';
    //     }
    //     $.notify({
    //         // options
    //         icon: iconUse,
    //         title: '',
    //         message: message,
    //         url: _url,
    //         target: '_blank'
    //     }, {
    //         // settings
    //         element: 'body',
    //         position: null,
    //         type: messageType,
    //         allow_dismiss: true,
    //         newest_on_top: false,
    //         showProgressbar: false,
    //         placement: {
    //             from: "bottom",
    //             align: "right"
    //         },
    //         offset: 20,
    //         spacing: 10,
    //         z_index: 1031,
    //         delay: 5000,
    //         timer: 1000,
    //         url_target: '_blank',
    //         mouse_over: null,
    //         animate: {
    //             enter: 'animated fadeInDown',
    //             exit: 'animated fadeOutUp'
    //         },
    //         onShow: null,
    //         onShown: null,
    //         onClose: null,
    //         onClosed: null,
    //         icon_type: 'class',
    //         template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
    //             '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
    //             '<span data-notify="icon"></span> ' +
    //             '<span data-notify="title">{1}</span> ' +
    //             '<span data-notify="message">{2}</span>' +
    //             '<div class="progress" data-notify="progressbar">' +
    //             '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
    //             '</div>' +
    //             '<a href="{3}" target="{4}" data-notify="url"></a>' +
    //             '</div>'
    //     });
    // }

    // MULTI-IMAGE UPLOAD
    if (window.File && window.FileList && window.FileReader) {
        $("#files").on("change", function(e) {
            var files = e.target.files,
                filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
                var f = files[i]
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                    var file = e.target;
                    $("<span class=\"pip\">" +
                        "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                        "<br/><span class=\"remove\"><img src='./images/delete-icon.svg'></span>" +
                        "</span>").appendTo(".upload-img-container");
                });
                fileReader.readAsDataURL(f);
            }
        });
        $(".remove").click(function() {
            $(this).parent(".pip").remove();
        });
    } else {
        alert("Your browser doesn't support to File API")
    }


});

var Loader = function() {

    return {

        show: function() {
            jQuery("#preloader").show();
        },

        hide: function() {
            jQuery("#preloader").hide();
        }
    };

}();