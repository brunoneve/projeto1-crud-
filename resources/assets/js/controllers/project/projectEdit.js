angular.module('app.controllers')
    .controller('ProjectEditController',
        ['$scope', '$location', '$routeParams', 'Project', 'Client', 'appConfig',
            function ($scope, $location, $routeParams, Project, Client, appConfig) {

                $scope.project = Project.get({id: $routeParams.id});
                $scope.clients = new Client.query();
                $scope.status = appConfig.project.status;

                $scope.save = function () {
                    if ($scope.form.$valid) {
                        $scope.project.owner_id = $cookies.getObject('user').id;
                        Project.update({id: $scope.project.id}, $scope.project,
                            $scope.project,function () {
                                $location.path('/projects');
                        });
                    }
                };
            }
        ]);