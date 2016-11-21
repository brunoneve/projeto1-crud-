angular.module('app.controllers')
    .controller('ProjectNewController',
        ['$scope','$location', '$cookies', '$routeParams', 'Project', 'Client', 'appConfig', 'limitToFilter',
            function($scope, $location, $cookies, $routeParams, Project, Client, appConfig,limitToFilter){

                $scope.project = new Project();
                $scope.clients = new Client.query();
                $scope.status = appConfig.project.status;

                $scope.save = function () {
                    if ($scope.form.$valid) {
                        $scope.project.owner_id = $cookies.getObject('user').id;
                        $scope.project.$save()
                        .then(function ()
                        {
                            $location.path('/projects');
                        });
                    }
                };

                $scope.formatName = function(model){
                    if(model){
                        return model.name;
                    }
                    return '';
                };

                $scope.getClients = function(name){
                    return Client.query({
                        search: name,
                        searchFields: 'name:like'
                    }).$promise.then(function(data) {
                        return limitToFilter(data, 10);
                    });
                };

                $scope.selectClient = function (item) {
                    $scope.project.client_id = item.id;
                };

    }]);
