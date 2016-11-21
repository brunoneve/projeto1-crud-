angular.module('app.controllers')
    .controller('HomeController',['$scope', '$cookies', function($scope,$cookies){
        $scope.userName = $cookies.getObject('user').name;
    }])