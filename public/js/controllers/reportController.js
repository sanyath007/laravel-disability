app.controller('reportController', function($scope, $http, CONFIG) {
    $scope.cboYear = parseInt(moment().format('YYYY')) + 543;
    $scope.disabilities = [];
    $scope.types = [];
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
            const year = parseInt(moment(event.date).format('YYYY')) + 543;

            $scope.search(year);
        });

    $scope.getListType = function(year = '') {
        $http.get(`${CONFIG.baseUrl}/disabilities/list?year=${year}`)
        .then(res => {
            $scope.setDisabilities(res);
        }, err => {
            console.log(err);
        });
    };

    $scope.setDisabilities = function(res) {
        const { data, ...pager } = res.data.disabilities;
        $scope.types = res.data.types;

        $scope.disabilities = data.map((disability) => {
            const types = disability.disability_type.split(',');

            return { ...disability, disability_type: types };
        });
        $scope.pager = pager;
    };

    $scope.getDataWithUrl = function(e, url, cb) {
        /** Check whether parent of clicked a tag is .disabled just do nothing */
        if ($(e.currentTarget).parent().is('li.disabled')) return;

        $scope.loading = true;
        const year = $scope.cboYear === '' ? parseInt(moment().format('YYYY')) + 543 : $scope.cboYear;

        $http.get(`${url}&year=${year}`)
        .then(function(res) {
            cb(res);

            $scope.loading = false;
        }, function(err) {
            console.log(err);
            $scope.loading = false;
        });
    };

    $scope.renderType = function(dtype) {
        return $scope.types.find(type => type.disability_type_id == dtype).disability_type_name;
    }
});