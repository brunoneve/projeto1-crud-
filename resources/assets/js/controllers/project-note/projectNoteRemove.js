angular.module('app.controllers')
    .controller('ProjectNoteRemoveController',
        ['$scope', '$location', '$routeParams', 'ProjectNote',
            function ($scope, $location, $routeParams, ProjectNote) {
                var projectId = $routeParams.projectId;
                $scope.projectId = projectId;

                ProjectNote.get({
                    projectId: projectId,
                    id: $routeParams.id
                }, function (data) {
                    //Volta com array n sei pq , então estou acessando o 0 pois so tem 1 registro mesmo
                    $scope.projectNote = data.data[0];
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