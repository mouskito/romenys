user.controller('EditUserController', ['$scope', '$http', '$routeParams', function ($scope, $http, $routeParams) {

    $http.get('/app.php?route=user_edit&uniqueId=' + $routeParams.uniqueId)
        .then(
            function (response) {
                $scope.user = response.data.user;
                console.log($scope.user);
            },
            function (response) {
                console.log(response.status);
            }
        );

    $scope.update = function (user) {
        $http.post('/app.php?route=user_edit&uniqueId=' + $routeParams.uniqueId, {user: user})
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
