angular.module('app.controllers')
    .controller('ProjectFileNewController',
        ['$scope','$location', '$routeParams', 'appConfig', 'Upload', 'Url',
            function($scope, $location, $routeParams, appConfig, Upload, Url){
                $scope.projectFile = {
                    project_id: $routeParams.projectId
                };

                $scope.save = function () {
                    if ($scope.form.$valid) {

                        var url = appConfig.baseUrl + Url.getUrlFromUrlSymbol(appConfig.urls.projectFile,{
                            projectId: $routeParams.projectId
                        });
                        Upload.upload({
                            url: url,
                            data: {
                                file: $scope.projectFile.file,
                                'name': $scope.projectFile.name,
                                'description': $scope.projectFile.description,
                            }
                        }).success(function (data,status,headers,config) {
                            $location.path('/project/' + $routeParams.projectId + '/files');
                        });
                    }
                };
    }]);
