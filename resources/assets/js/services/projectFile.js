angular.module('app.services')
    .service('ProjectFile', ['$resource','appConfig', 'Url', function($resource,appConfig,Url){
        var url = appConfig.baseUrl + Url.getUrlResource(appConfig.urls.projectFile);
        return $resource(url,
            {
                projectId:'@projectId',
                id:'@id'
            },

            {
                update: {
                    method:'PUT'
                }
        });
   }]);