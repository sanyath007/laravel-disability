app.controller('disabilityController', function($scope, $http, CONFIG) {
    $scope.cboYear = parseInt(moment().format('YYYY')) + 543;
    $scope.disabilities = [];
    $scope.pager = null;
    $scope.loading = false;

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
            $scope.setDisabilities(res);
        }, err => {
            console.log(err);
        });
    };

    $scope.setDisabilities = function(res) {
        const { data, ...pager } = res.data.disabilities;
        $scope.disabilities = data;
        $scope.pager = pager;
    };

    $scope.getDataWithUrl = function(e, URL, cb) {
        /** Check whether parent of clicked a tag is .disabled just do nothing */
        if ($(e.currentTarget).parent().is('li.disabled')) return;

        $scope.loading = true;

        $http.get(URL)
        .then(function(res) {
            cb(res);

            $scope.loading = false;
        }, function(err) {
            console.log(err);
            $scope.loading = false;
        });
    };
});