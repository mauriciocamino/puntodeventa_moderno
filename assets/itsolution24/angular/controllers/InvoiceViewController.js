window.angularApp.controller("InvoiceViewController", [
    "$scope",
    "API_URL",
    "window",
    "jQuery",
    "$compile",
    "$uibModal",
    "$http",
    "$sce", 
    "InvoiceSMSModal",
    "EmailModal",
function (
    $scope,
    API_URL,
    window,
    $,
    $compile,
    $uibModal,
    $http,
    $sce,
    InvoiceSMSModal,
    EmailModal
) {
    "use strict";

    $scope.InvoiceSMSModal = function() {
        InvoiceSMSModal($scope);
    }

    $("#sms-btn").on( "click", function (e) {
        e.stopPropagation();
        var invoiceID = $(this).data("invoiceid");
        $scope.invoiceID = invoiceID;
        InvoiceSMSModal($scope);
    });

    $("#email-btn").on( "click", function (e) {
        e.stopPropagation();
        var recipientName = $(this).data("customername");
        var thehtml = $("#invoice").html();
        var invoice = {
            template: "invoice", 
            styles:$($("#invoice").html()).find("#styles").text(),
            subject: "Invoice#"+$(this).data("invoiceid"), 
            title: "Enviar factura por correo electrónico", 
            recipientName: recipientName, 
            senderName: window.store.name, 
            html: thehtml
        };
        EmailModal(invoice);
    });
}]);