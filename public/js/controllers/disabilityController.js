app.controller('disabilityController', function($scope, $http, CONFIG) {
    $scope.cboYear = parseInt(moment().format('YYYY')) + 543;
    $scope.disabilities = [];
    $scope.pager = null;

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

    $("#cboYear")
        .datepicker(initDateYearPicker)
        .on('changeDate', function(event) {
            $scope.search(moment(event.date).format('YYYY'));
        });

    $scope.search = function(year = '') {
        $http.get(`${CONFIG.baseUrl}/disabilities/list?year=${year}`)
        .then(res => {
            console.log(res);
            const { data, ...pager } = res.data.disabilities;
            $scope.disabilities = data;
            $scope.pager = pager;

            console.log($scope.disabilities);
        }, err => {
            console.log(err);
        });
    }
});