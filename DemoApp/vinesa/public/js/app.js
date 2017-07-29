(function () {
  var app = angular.module('vinesa', []);
  app.controller('dataController', function ($http, $q, $scope) {

    var deferred = $q.defer();
    var promise = deferred.promise;
    $http({
        method: 'GET',
        url: 'http://localhost:9000/data/data.JSON'
        }).then(function successCallback(response) {
          return deferred.resolve(response);
        }, function errorCallback(response) {
          return deferred.reject(response);
        });

    promise
      .then(function(data){
        //var $scope.vinesaData = data.data;
      })
      .catch(function(error){
        console.log(error);
      })


  });
})();
