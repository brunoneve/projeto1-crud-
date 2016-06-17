angular.module('app.controllers')
    .controller('ClientEditController',
        ['$scope','$location', '$routeParams','Client',
            function($scope, $location, $routeParams, Client){
                
                $scope.clientData = Client.get({id: $routeParams.id}, function(data){
                    $scope.client = data.data;
                });

                $scope.save = function(){
                    if($scope.form.$valid)
                    {
                        Client.update({id:$scope.client.id}, $scope.client, function(){
                            $location.path('/clients');
                        });
                    }

                }
    }]);