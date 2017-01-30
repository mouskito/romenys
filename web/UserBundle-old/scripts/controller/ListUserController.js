user.controller('ListUserController', ['$scope', '$http', function ($scope, $http) {
    console.log('ListUserController');

    $http.get('/app.php?route=user_list')
        .then(
            function (response) {
                $scope.users = response.data.users;
                console.log($scope.users);
            },
            function (response) {
                console.log(response.status);
            }
        );

        $scope.deleteOne = function (user) {
        $http.post('/app.php?route=user_delete', {user: user})
            .then(
                function (response) {
                    console.log(response);
                },
                function (response) {
                    console.log(response);
                }
            );
    }
}]);