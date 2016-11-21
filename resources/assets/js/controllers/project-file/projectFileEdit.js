angular.module('app.controllers')
    .controller('ProjectFileEditController',
        ['$scope', '$location', '$routeParams', 'ProjectNote',
            function ($scope, $location, $routeParams, ProjectNote) {
                var projectId = $routeParams.projectId;
                $scope.projectId = projectId;

                $scope.projectNote = ProjectNote.get({
                    projectId: projectId,
                    id: $routeParams.id
                });


                $scope.save = function () {
                    if ($scope.form.$valid) {
                        ProjectNote.update({
                            projectId: projectId,
                            id: $routeParams.id
                        },
                        $scope.projectNote,function () {
                            $location.path('/project/' + projectId + '/notes');
                        });
                    }
                };
            }
        ]);