angular.module('app.directives')
    .directive('projectFileDownload', ['$timeout', 'appConfig', 'ProjectFile', function ($timeout, appConfig, ProjectFile) {
        return {
            restrict: 'E',
            templateUrl: appConfig.baseUrl + '/build/views/templates/fileDownload.html',
            link: function(scope, element, attr) {
                var anchor = element.children()[0];
                scope.$on('salvar-arquivo', function(event, data) {
                    $(anchor).removeClass('disabled');
                    $(anchor).attr({
                        href: 'data:application-octet-stream;base64,'+data.file,
                        download: data.name
                    });

                    $timeout(function() {
                        scope.downloadFile = function() {};
                        $(anchor)[0].click();
                    });


                });
            },
            controller: ['$scope', '$element', '$attrs',
                function($scope, $element, $attrs) {
                    $scope.downloadFile = function() {
                        var anchor = $element.children()[0];
                        $(anchor).addClass('disabled');

                        ProjectFile.download({projectId:null, idFile: $attrs.idFile} , function(data){
                            $scope.$emit('salvar-arquivo', data);
                        });
                    };
                }]
        };
    }]);