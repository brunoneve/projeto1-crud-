angular.module('app.services')
    .service('Project', ['$resource','appConfig', function($resource,appConfig){
        return $resource(

            appConfig.baseUrl + '/project/:id',
            {
                id:'@id'
            },

            {
                query: {
                    method: 'GET',
                    isArray: false
                },
                update: {
                    method:'PUT'
                }
        });
   }]);