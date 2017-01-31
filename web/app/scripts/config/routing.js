/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 17/12/16
 * Time: 01:29
 */

'use strict';

app.config(function($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: 'web/app/templates/dashboard.html',
            controller: 'DashboardController'
        });
});
