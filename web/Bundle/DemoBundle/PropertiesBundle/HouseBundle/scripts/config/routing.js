'use strict';

house.config(function($routeProvider) {
    $routeProvider
        .when('/house/new/', {
            templateUrl: 'web/Bundle/DemoBundle/PropertiesBundle/HouseBundle/templates/new.html',
            controller: 'NewHouseController'
        });
});
