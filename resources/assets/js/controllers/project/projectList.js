angular.module('app.controllers')
    .controller('ProjectListController',[
        '$scope', '$routeParams', 'Project',
        function($scope, $routeParams, Project){

            $scope.projectData = Project.query({},
                function (data) {
                    $scope.projects = data.data;
            });
    }]);
