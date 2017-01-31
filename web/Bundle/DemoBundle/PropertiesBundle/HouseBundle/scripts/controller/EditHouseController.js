house.controller('EditHouseController', ['$scope', '$http', '$routeParams', function ($scope, $http, $routeParams) {

    $http.get('/app.php?route=house_edit&id=' + $routeParams.id)
        .then(
            function (response) {
                $scope.house = response.data.house;
            },
            function (response) {
                console.log(response.status);
            }
        );

    $scope.update = function (house) {
        $http.post('/app.php?route=house_edit&id=' + $routeParams.id, {house: house})
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