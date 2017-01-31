house.controller('ListHouseController', ['$scope', '$http', function ($scope, $http) {
    console.log('ListHouseController');

    $http.get('/app.php?route=house_list')
        .then(
            function (response) {
                $scope.houses = response.data.houses;
                console.log($scope.houses);
            },
            function (response) {
                console.log(response.status);
            }
        );

        $scope.delete = function (house) {
        $http.post('/app.php?route=house_delete&id=' + $routeParams.id, {house: house})
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

