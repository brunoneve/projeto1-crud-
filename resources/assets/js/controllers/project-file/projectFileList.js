angular.module('app.controllers')
    .controller('ProjectFileListController',[
        '$scope', '$routeParams', 'ProjectNote',
        function($scope, $routeParams, ProjectNote){
            var projectId = $routeParams.projectId;

            $scope.projectId = projectId;
            $scope.notes = ProjectNote.query({projectId: projectId});
    }]);
