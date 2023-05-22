window.angularApp.controller("StoreActionController", [
    "$scope",
    "API_URL",
    "window",
    "jQuery",
    "$compile",
    "$uibModal",
    "$http",
    "$sce",
function (
    $scope,
    API_URL,
    window,
    $,
    $compile,
    $uibModal,
    $http,
    $sce
) {
    "use strict";

    $("#reference_format").on("change", function(e) {
        if ($(this).val() == 'resolucion') {
            $("#resolucion").removeClass('hide');
        }else{
            $("#resolucion").addClass('hide');
        }
    });

    // update store
    $("#update-store-btn").on("click", function(e) {
        e.preventDefault();

        var referencia = $("#reference_format").val();
        var consecutive = $("#consecutive").val();
        var since = $("#since").val();
        var until = $("#until").val();
        var resolution = $("#resolution").val();
        var regime = $("#regime").val();
        var date_since = $("#date_since").val();

        if (referencia == 'resolucion') {
            var conteo=0;
            if (consecutive == '') {
                $("#consecutive").addClass('has-error');
                conteo++;
            }
            if (since == '') {
                $("#since").addClass('has-error');
                conteo++;
            }
            if (resolution == '') {
                $("#resolution").addClass('has-error');
                conteo++;
            }
            if (until == '') {
                $("#until").addClass('has-error');
                conteo++;
            }
            if (regime == '') {
                $("#regime").addClass('has-error');
                conteo++;
            }
            if (date_since == '') {
                $("#date_since").addClass('has-error');
                conteo++;
            }
            if (conteo>0) {
                $(".pos-setting").trigger('click');
                $('html, body').animate({scrollTop:0}, 'slow');
                window.toastr.warning('Los Campos con (*) son requeridos.. En Menu -> AJUSTES POS ', "Advertencia!");
                return false;
            }
        }

        console.log("papapapapa");

        var $tag = $(this);
        var $btn = $tag.button("loading");
        var form = $($tag.data('form'));
        form.find(".alert").remove();
        var actionUrl = form.attr("action");
        
        $http({
            url: window.baseUrl + "/_inc/" + actionUrl,
            method: "POST",
            data: form.serialize(),
            cache: false,
            processData: false,
            contentType: false,
            dataType: "json"
        }).
        then(function(response) {

            $btn.button("reset");
            $(":input[type=\"button\"]").prop("disabled", false);
            var alertMsg = response.data.msg;
             window.toastr.success(alertMsg, "Exito!");

        }, function(response) {

            $btn.button("reset");
            $(":input[type=\"button\"]").prop("disabled", false);
            var alertMsg = "<div>";
            window.angular.forEach(response.data, function(value) {
                alertMsg += "<p>" + value + ".</p>";
            });
            alertMsg += "</div>";
            window.toastr.warning(alertMsg, "Advertencia!");
        });
    });
    
    // Create store
    $("#create-store-btn").on("click", function(e) {
        e.preventDefault();

        var $tag = $(this);
        var $btn = $tag.button("loading");
        var form = $($tag.data('form'));
        form.find(".alert").remove();
        var actionUrl = form.attr("action");
        
        $http({
            url: window.baseUrl + "/_inc/" + actionUrl,
            method: "POST",
            data: form.serialize(),
            cache: false,
            processData: false,
            contentType: false,
            dataType: "json"
        }).
        then(function(response) {

            $btn.button("reset");
            $(":input[type=\"button\"]").prop("disabled", false);
            var alertMsg = response.data.msg;
             window.toastr.success(alertMsg, "Exito!");
            window.location = 'store_single.php?store_id=' + response.data.id + '&box_state=open';

        }, function(response) {

            $btn.button("reset");
            $(":input[type=\"button\"]").prop("disabled", false);
            var alertMsg = "<div>";
            window.angular.forEach(response.data, function(value) {
                alertMsg += "<p>" + value + ".</p>";
            });
            alertMsg += "</div>";
            window.toastr.warning(alertMsg, "Advertencia!");
        });
    });

    $scope.indianGST = false;
    $('#invoice_view').on('select2:select', function (e) {
        var data = e.params.data;
        if (data.element.value == "indian_gst") {
            $scope.$apply(function () {
                $scope.indianGST = true;
            });
        } else {
            $scope.$apply(function () {
                $scope.indianGST = false;
            });
        }
    });
    if (window.settings.invoice_view == 'indian_gst') {
        $scope.indianGST = true;
    }

    $scope.isMailFunction = false;
    $scope.isSEndMail = false;
    $scope.isSMTP = false;
    $scope.triggerMailServer = function(value) {
        if (value == "mail_function") {
            $scope.isMailFunction = true;
            $scope.isSendMail = false;
            $scope.isSMTP = false;
        }
        if (value == "send_mail") {
            $scope.isMailFunction = false;
            $scope.isSendMail = true;
            $scope.isSMTP = false;
        }
        if (value == "smtp_server") {
            $scope.isMailFunction = false;
            $scope.isSendMail = false;
            $scope.isSMTP = true;
        }
    };
    $scope.triggerMailServer(window.settings.email_driver);

    $('#email_driver').on('select2:select', function (e) {
        var data = e.params.data;
        var isMailFunction = false;
        var isSendMail = false;
        var isSMTP = false;

        if (data.element.value == "mail_function") {
            isMailFunction = true;
            isSendMail = false;
            isSMTP = false;
        }
        if (data.element.value == "send_mail") {
            isMailFunction = false;
            isSendMail = true;
            isSMTP = false;
        }
        if (data.element.value == "smtp_server") {
            isMailFunction = false;
            isSendMail = false;
            isSMTP = true;
        }

        $scope.$apply(function () {
            $scope.isMailFunction = isMailFunction;
            $scope.isSendMail = isSendMail;
            $scope.isSMTP = isSMTP;
        });
    });
}]);