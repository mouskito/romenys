user.controller('ShowUserController', ['$scope', '$http', '$routeParams', function ($scope, $http, $routeParams) {
    console.log('ShowUserController');

    $http.get('/app.php?route=user_show&uniqueId=' + $routeParams.uniqueId)
        .then(
            function (response) {
                $scope.user = response.data.user;
                console.log($scope.user);
            },
            function (response) {
                console.log(response.status);
            }
        );

       $scope.findByUniqueId = function (user) {
        $http.get('/app.php?route=user_show&uniqueId=' + $routeParams.uniqueId, {user: user})
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