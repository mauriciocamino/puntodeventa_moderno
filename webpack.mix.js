const mix = require('laravel-mix');

// // Main CSS
// mix.styles([

//     // Plugins
//     'assets/bootstrap/css/bootstrap.css',
//     'assets/jquery-ui/jquery-ui.min.css',
//     'assets/font-awesome/css/font-awesome.css',
//     'assets/morris/morris.css',
//     'assets/select2/select2.min.css',
//     'assets/datepicker/datepicker3.css',
//     'assets/timepicker/bootstrap-timepicker.css',
//     'assets/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
//     'assets/perfectScroll/css/perfect-scrollbar.css',
//     'assets/toastr/toastr.min.css',

//     // Filemanager
//     'assets/template/css/filemanager/dialogs.css',
//     'assets/template/css/filemanager/main.css',

//     // Theme
//     'assets/template/css/theme.css',
//     'assets/template/css/skins/skin-black.css',
//     'assets/template/css/skins/skin-blue.css',
//     'assets/template/css/skins/skin-green.css',
//     'assets/template/css/skins/skin-red.css',
//     'assets/template/css/skins/skin-yellow.css',

//     // DataTable
//     'assets/DataTables/datatables.min.css',

//     // Main CSS
//     'assets/template/css/main.css',

//     // Responsive CSS
//     'assets/template/css/responsive.css',

//     // Barcode CSS
//     // 'assets/template/css/barcode.css',

//     // Print CSS
//     'assets/template/css/print.css',

// ],'assets/template/cssmin/main.css');



// // POS CSS
// mix.styles([

//     'assets/bootstrap/css/bootstrap.css',
//     'assets/jquery-ui/jquery-ui.min.css',
//     'assets/font-awesome/css/font-awesome.css',
//     'assets/datepicker/datepicker3.css',
//     'assets/timepicker/bootstrap-timepicker.min.css',
//     'assets/perfectScroll/css/perfect-scrollbar.css',
//     'assets/select2/select2.min.css',
//     'assets/toastr/toastr.min.css',
//     'assets/contextMenu/dist/jquery.contextMenu.min.css',

//     // Filemanager
//     'assets/template/css/filemanager/dialogs.css',
//     'assets/template/css/filemanager/main.css',

//     // Theme
//     'assets/template/css/theme.css',
//     'assets/template/css/skins/skin-black.css',
//     'assets/template/css/skins/skin-blue.css',
//     'assets/template/css/skins/skin-green.css',
//     'assets/template/css/skins/skin-red.css',
//     'assets/template/css/skins/skin-yellow.css',
//     'assets/template/css/main.css',

//     // Main
//     'assets/template/css/pos/skeleton.css',
//     'assets/template/css/pos/pos.css',
//     'assets/template/css/pos/responsive.css',

// ],'assets/template/cssmin/pos.css');



// // LOGIN CSS
// mix.styles([

//     'assets/bootstrap/css/bootstrap.css',
//     'assets/perfectScroll/css/perfect-scrollbar.css',
//     'assets/toastr/toastr.min.css',
//     'assets/template/css/theme.css',
//     'assets/template/css/login.css',

// ],'assets/template/cssmin/login.css');



// Angular JS
mix.scripts([

    'assets/template/angular/lib/angular/angular.min.js',
    'assets/template/angular/lib/angular/angular-sanitize.js',
    'assets/template/angular/lib/angular/angular-bind-html-compile.min.js',
    'assets/template/angular/lib/angular/ui-bootstrap-tpls-2.5.0.min.js',
    'assets/template/angular/lib/angular/angular-route.min.js',
    'assets/template/angular/lib/angular-translate/dist/angular-translate.min.js',
    'assets/template/angular/lib/ng-file-upload/dist/ng-file-upload.min.js',
    'assets/template/angular/lib/angular-local-storage.min.js',
    'assets/template/angular/angularApp.js',
    
],'assets/template/angularmin/angular.js');

// Angular Filemanager JS
mix.scripts([

    'assets/template/angular/filemanager/js/directives/directives.js',
    'assets/template/angular/filemanager/js/filters/filters.js',
    'assets/template/angular/filemanager/js/providers/config.js',
    'assets/template/angular/filemanager/js/entities/chmod.js',
    'assets/template/angular/filemanager/js/entities/item.js',
    'assets/template/angular/filemanager/js/services/apihandler.js',
    'assets/template/angular/filemanager/js/services/apimiddleware.js',
    'assets/template/angular/filemanager/js/services/filenavigator.js',
    'assets/template/angular/filemanager/js/providers/translations.js',
    'assets/template/angular/filemanager/js/controllers/main.js',
    'assets/template/angular/filemanager/js/controllers/selector-controller.js',

],'assets/template/angularmin/filemanager.js');



// Angular Modal JS
mix.scripts([

    'assets/template/angular/modals/InvoiceViewModal.js',
    'assets/template/angular/modals/InvoiceInfoEditModal.js',
    'assets/template/angular/modals/BoxCreateModal.js',
    'assets/template/angular/modals/BoxDeleteModal.js',
    'assets/template/angular/modals/BoxEditModal.js',
    'assets/template/angular/modals/UnitCreateModal.js',
    'assets/template/angular/modals/UnitDeleteModal.js',
    'assets/template/angular/modals/UnitEditModal.js',
    'assets/template/angular/modals/TaxrateCreateModal.js',
    'assets/template/angular/modals/TaxrateDeleteModal.js',
    'assets/template/angular/modals/TaxrateEditModal.js',
    'assets/template/angular/modals/CategoryCreateModal.js',
    'assets/template/angular/modals/CategoryDeleteModal.js',
    'assets/template/angular/modals/CategoryEditModal.js',
    'assets/template/angular/modals/CurrencyEditModal.js',
    'assets/template/angular/modals/CustomerCreateModal.js',
    'assets/template/angular/modals/CustomerDeleteModal.js',
    'assets/template/angular/modals/CustomerEditModal.js',
    'assets/template/angular/modals/SupportDeskModal.js',
    'assets/template/angular/modals/DueCollectionDetailsModal.js',
    'assets/template/angular/modals/BankingDepositModal.js',
    'assets/template/angular/modals/BankingRowViewModal.js',
    'assets/template/angular/modals/BankingWithdrawModal.js',
    'assets/template/angular/modals/BankAccountCreateModal.js',
    'assets/template/angular/modals/BankAccountDeleteModal.js',
    'assets/template/angular/modals/BankAccountEditModal.js',
    'assets/template/angular/modals/BankTransferModal.js',
    'assets/template/angular/modals/EmailModal.js',
    'assets/template/angular/modals/KeyboardShortcutModal.js',
    'assets/template/angular/modals/PmethodDeleteModal.js',
    'assets/template/angular/modals/PmethodEditModal.js',
    'assets/template/angular/modals/PayNowModal.js',
    'assets/template/angular/modals/POSFilemanagerModal.js',
    'assets/template/angular/modals/POSReceiptTemplateEditModal.js',
    'assets/template/angular/modals/PrinterDeleteModal.js',
    'assets/template/angular/modals/PrinterEditModal.js',
    'assets/template/angular/modals/PrintReceiptModal.js',
    'assets/template/angular/modals/ProductCreateModal.js',
    'assets/template/angular/modals/ProductDeleteModal.js',
    'assets/template/angular/modals/ProductEditModal.js',
    'assets/template/angular/modals/ProductReturnModal.js',
    'assets/template/angular/modals/ProductViewModal.js',
    'assets/template/angular/modals/StoreDeleteModal.js',
    'assets/template/angular/modals/SupplierCreateModal.js',
    'assets/template/angular/modals/SupplierDeleteModal.js',
    'assets/template/angular/modals/SupplierEditModal.js',
    'assets/template/angular/modals/BrandCreateModal.js',
    'assets/template/angular/modals/BrandDeleteModal.js',
    'assets/template/angular/modals/BrandEditModal.js',
    'assets/template/angular/modals/UserCreateModal.js',
    'assets/template/angular/modals/UserDeleteModal.js',
    'assets/template/angular/modals/UserEditModal.js',
    'assets/template/angular/modals/UserGroupCreateModal.js',
    'assets/template/angular/modals/UserGroupDeleteModal.js',
    'assets/template/angular/modals/UserGroupEditModal.js',
    'assets/template/angular/modals/UserInvoiceDetailsModal.js',
    'assets/template/angular/modals/GiftcardCreateModal.js',
    'assets/template/angular/modals/GiftcardEditModal.js',
    'assets/template/angular/modals/GiftcardViewModal.js',
    'assets/template/angular/modals/GiftcardTopupModal.js',
    'assets/template/angular/modals/InvoiceSMSModal.js',
    'assets/template/angular/modals/PaymentFormModal.js',
    'assets/template/angular/modals/PaymentOnlyModal.js',
    'assets/template/angular/modals/PurchaseInvoiceViewModal.js',
    'assets/template/angular/modals/PurchaseInvoiceInfoEditModal.js',
    'assets/template/angular/modals/PurchasePaymentModal.js',
    'assets/template/angular/modals/SellReturnModal.js',
    'assets/template/angular/modals/PurchaseReturnModal.js',
    'assets/template/angular/modals/ExpenseSummaryModal.js',
    'assets/template/angular/modals/SummaryReportModal.js',
    
],'assets/template/angularmin/modal.js');



// Main JS
mix.scripts([

    'assets/jquery/jquery.min.js',
    'assets/jquery-ui/jquery-ui.min.js',
    'assets/bootstrap/js/bootstrap.min.js',
    'assets/chartjs/Chart.min.js',
    'assets/sparkline/jquery.sparkline.min.js',
    'assets/datepicker/bootstrap-datepicker.js',
    'assets/timepicker/bootstrap-timepicker.min.js',
    'assets/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
    'assets/select2/select2.min.js',
    'assets/perfectScroll/js/perfect-scrollbar.jquery.min.js',
    'assets/sweetalert/sweetalert.min.js',
    'assets/toastr/toastr.min.js',
    'assets/accounting/accounting.min.js',
    'assets/underscore/underscore.min.js',
    'assets/template/js/ie.js',
    'assets/template/js/theme.js',
    'assets/template/js/common.js',
    'assets/template/js/main.js',
    'assets/DataTables/datatables.min.js',
    'assets/template/angularmin/angular.js',
    'assets/template/angularmin/modal.js',
    'assets/template/angularmin/filemanager.js',

],'assets/template/jsmin/main.js');



// POS JS
mix.scripts([

    'assets/jquery/jquery.min.js',
    'assets/jquery-ui/jquery-ui.min.js',
    'assets/bootstrap/js/bootstrap.min.js',
    'assets/template/angularmin/angular.js',
    'assets/template/angular/angularApp.js',
    'assets/template/angularmin/filemanager.js',
    'assets/template/angularmin/modal.js',

    'assets/datepicker/bootstrap-datepicker.js',
    'assets/timepicker/bootstrap-timepicker.min.js',
    'assets/select2/select2.min.js',
    'assets/perfectScroll/js/perfect-scrollbar.jquery.min.js',
    'assets/sweetalert/sweetalert.min.js',
    'assets/toastr/toastr.min.js',
    'assets/accounting/accounting.min.js',
    'assets/underscore/underscore.min.js',
    'assets/contextMenu/dist/jquery.contextMenu.min.js',
    'assets/template/js/ie.js',

    'assets/template/js/common.js',
    'assets/template/js/main.js',
    'assets/template/js/pos/pos.js',

],'assets/template/jsmin/pos.js');


// LOGIN JS
mix.scripts([

    'assets/jquery/jquery.min.js',
    'assets/bootstrap/js/bootstrap.min.js',
    'assets/perfectScroll/js/perfect-scrollbar.jquery.min.js',
    'assets/toastr/toastr.min.js',
    'assets/template/js/forgot-password.js',
    'assets/template/js/common.js',
    'assets/template/js/login.js',

],'assets/template/jsmin/login.js');



// How to build assets
// npm run dev
// npm run production