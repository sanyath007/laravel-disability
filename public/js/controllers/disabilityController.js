app.controller('disabilityController', function($scope, $http, CONFIG) {
    $scope.cboYear = parseInt(moment().format('YYYY')) + 543;

    const initDateMonthPicker = {
        autoclose: true,
        language: 'th',
        format: 'mm/yyyy',
        thaiyear: true,
        viewMode: "months", 
        minViewMode: "months",
    };

    const initDateYearPicker = {
        autoclose: true,
        format: 'yyyy',
        viewMode: "years", 
        minViewMode: "years",
        language: 'th',
        thaiyear: true
    };

    $("#cboYear").datepicker(initDateYearPicker)
});