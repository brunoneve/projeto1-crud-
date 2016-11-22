angular.module('app.controllers')
    .controller('ProjectFileEditController',
        ['$scope', '$location', '$routeParams', 'ProjectFile',
            function ($scope, $location, $routeParams, ProjectFile) {
                var projectId = $routeParams.projectId;
                $scope.projectId = projectId;

                $scope.projectFile = ProjectFile.get({projectId: null,idFile: $routeParams.id});

                $scope.save = function () {
                    if ($scope.form.$valid) {
                        ProjectFile.update({
                            idFile: $routeParams.id
                        },
                        $scope.projectFile,function () {
                            $location.path('/project/' + projectId + '/files');
                        });
                    }
                };
            }
        ]);