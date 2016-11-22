angular.module('app.controllers')
    .controller('ProjectFileRemoveController',
        ['$scope', '$location', '$routeParams', 'ProjectFile',
            function ($scope, $location, $routeParams, ProjectFile) {
                var projectId = $routeParams.projectId;
                $scope.projectId = projectId;

                $scope.file = ProjectFile.get({
                    idFile: $routeParams.id
                });

                $scope.remove = function () {
                    ProjectFile.delete({
                        idFile: $routeParams.id
                        },function () {
                            $location.path('/project/' + projectId + '/files');
                        }
                    );
                };
            }
        ]);