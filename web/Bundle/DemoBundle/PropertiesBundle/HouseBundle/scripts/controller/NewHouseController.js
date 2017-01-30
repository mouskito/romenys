house.controller('NewHouseController', ['$scope', '$http', function ($scope, $http) {
    console.log('NewHouseController');

    $scope.create = function (house) {
        $http.post('/app.php?route=house_new', {house: house})
            .then(
                function (response) {
                    console.log(response);
                },
                function (response) {
                    console.log(response.status);
                }
            );
    }
}]);
