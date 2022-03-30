(function($) {
    var adminThemeAssessment = function() {
        $(document).ready(function() {
            c._initialize();
        });
    };
    var c = adminThemeAssessment.prototype;

    c._initialize = function() {
        c._listingView();
    };

    c._listingView = function() {
        var field_coloumns = [
            { "data": "checkbox", orderable: false, searchable: false },
            { "data": "name" },
            { "data": "email" },
            { "data": "created_at" },
            { "data": "status" },
            { className: "text-end", "data": "action", orderable: false, searchable: false },
        ];
        var order_coloumns = [
            [1, "desc"]
        ];
        adminTheme._generateDataTable('data_table', url, field_coloumns, order_coloumns);
    };
    window.adminThemeAssessment = new adminThemeAssessment();
})(jQuery);