house.controller('NewHouseController', ['$scope', '$http', function ($scope, $http) {

    $scope.house = {};

    $http.get('/app.php?route=user_list')
        .then(
            function (response) {
                console.log(response);
                $scope.house.users = response.data.users;
            }
        );

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
