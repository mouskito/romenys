'use strict';

user.config(function($routeProvider) {
    $routeProvider
        .when('/user/new/', {
            templateUrl: 'web/Bundle/DemoBundle/UserBundle/templates/new.html',
            controller: 'NewUserController'
        })
        .when('/user/edit/:uniqueId', {
            templateUrl: 'web/Bundle/DemoBundle/UserBundle/templates/edit.html',
            controller: 'EditUserController'
        })        
        .when('/user/list/', {
            templateUrl: 'web/Bundle/DemoBundle/UserBundle/templates/list.html',
            controller: 'ListUserController'
        })
        .when('/user/delete/:uniqueId', {
            templateUrl: 'web/Bundle/DemoBundle/UserBundle/templates/list.html',
            controller: 'DeleteUserController'
        })
        .when('/user/show/:uniqueId', {
            templateUrl: 'web/Bundle/DemoBundle/UserBundle/templates/show.html',
            controller: 'ShowUserController'
        });
});
