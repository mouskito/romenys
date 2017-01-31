'use strict';

house.config(function($routeProvider) {
    $routeProvider
        .when('/house/new/', {
            templateUrl: 'web/Bundle/DemoBundle/PropertiesBundle/HouseBundle/templates/new.html',
            controller: 'NewHouseController'
        })
        .when('/house/list/', {
            templateUrl: 'web/Bundle/DemoBundle/PropertiesBundle/HouseBundle/templates/list.html',
            controller: 'ListHouseController'
        });
});
