angular.module('app.controllers')
    .controller('ProjectNewController',
        ['$scope','$location', '$routeParams', 'Project', 'Client',
            function($scope, $location, $routeParams, Project, Client){

                $scope.project = new Project();
                $scope.clients = new Client.query();

                $scope.save = function () {
                    if ($scope.form.$valid) {
                        $scope.project.$save()
                        .then(function ()
                        {
                            $location.path('/projects');
                        });
                    }
                };
    }]);
