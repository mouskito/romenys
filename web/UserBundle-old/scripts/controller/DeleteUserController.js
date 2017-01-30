user.controller('DeleteUserController', ['$scope', '$http', function ($scope, $http) {
    console.log('DeleteUserController');


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