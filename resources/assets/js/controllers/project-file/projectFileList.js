angular.module('app.controllers')
    .controller('ProjectFileListController',[
        '$scope', '$routeParams', 'ProjectFile',
        function($scope, $routeParams, ProjectFile){
            var projectId = $routeParams.projectId;

            $scope.projectId = projectId;
            $scope.files = ProjectFile.query({projectId: projectId});
    }]);
