user.controller('NewUserController', ['$scope', '$http', function ($scope, $http) {
    console.log('NewUserController');

    $scope.create = function (user) {
        $http.post('/app.php?route=user_new', {user: user})
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
