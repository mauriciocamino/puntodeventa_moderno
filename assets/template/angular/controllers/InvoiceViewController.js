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

     $("#invoice_print").on("click", function (e) {
        var id = $(this).val();
        var store = window.store;
         $.ajax({
            url: '../_inc/invoice_print.php',
            type: 'POST',
            dataType:"json", 
            data: {id,store } ,
            success: function(datapp){
                   $.ajax({
            url: 'http://127.0.0.1//imprime/imprime.php',
            type: 'POST',
            dataType:"json", 
            data: {datapp} ,
            success: function(data){
            }
        });
            }
        });
   
     });


}]);