house.controller('ShowHouseController', ['$scope', '$http', '$routeParams', function ($scope, $http, $routeParams) {
    console.log('ShowHouseController');

    $http.get('/app.php?route=house_show&id=' + $routeParams.id)
        .then(
            function (response) {
                $scope.house = response.data.house;
                console.log($scope.house);
            },
            function (response) {
                console.log(response.status);
            }
        );
}]);