angular.module('app.controllers')
    .controller('ProjectNoteShowController',[
        '$scope', '$routeParams', 'ProjectNote',
        function($scope, $routeParams, ProjectNote){
            var projectId = $routeParams.projectId;

            $scope.projectId = projectId;
            $scope.projectNotes = ProjectNote.query({projectId: projectId},
                function (data) {
                    $scope.notes = data.data;
            });
    }]);
