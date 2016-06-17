angular.module('app.controllers')
    .controller('ClientListController',['$scope', 'Client', function($scope, Client){

        $scope.clientData = Client.query({}, function (data) {
            $scope.clients = data.data;
        });
    }]);