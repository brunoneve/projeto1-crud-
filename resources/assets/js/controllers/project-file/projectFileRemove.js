angular.module('app.controllers')
    .controller('ProjectFileRemoveController',
        ['$scope', '$location', '$routeParams', 'ProjectNote',
            function ($scope, $location, $routeParams, ProjectNote) {
                var projectId = $routeParams.projectId;
                $scope.projectId = projectId;

                $scope.note = ProjectNote.get({
                    projectId: projectId,
                    id: $routeParams.id
                });

                $scope.remove = function () {
                    ProjectNote.delete({
                        projectId: projectId,
                        id: $routeParams.id
                        },function () {
                            $location.path('/project/' + projectId + '/notes');
                        }
                    );
                };
            }
        ]);