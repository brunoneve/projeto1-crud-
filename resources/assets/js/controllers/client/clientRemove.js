angular.module('app.controllers')
    .controller('ClientRemoveController',
        ['$scope','$location', '$routeParams','Client',
            function($scope, $location, $routeParams, Client){
                $scope.client = Client.get({id: $routeParams.id});

                $scope.remove = function(){
                    Client.delete({id: $routeParams.id}, function(){
                        $location.path('/clients');
                    });
                }
    }]);