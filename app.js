// app.js
angular.module('sortApp', ['angularUtils.directives.dirPagination'])

.controller('mainController', function($scope, $http) {
  $http.get('tracks.json')
    .then (function(res){
      $scope.tracks = res.data; 
    });
  $scope.removeSong = function(row) {
  	$scope.tracks.splice($scope.tracks.indexOf(row),1);
  }
  $scope.sortType = 'Artist'; // set the default sort type
  $scope.sortReverse = false; // set the default sort order
});