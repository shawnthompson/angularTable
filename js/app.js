// app.js
var myApp = angular.module('myApp', ['angularUtils.directives.dirPagination'])

myApp.controller('listController', ['$scope', '$http', function($scope, $http) {
  $http.get('./data/tracks.json')
    .then (function(res){
      $scope.tracks = res.data; 
    });
  $scope.removeSong = function(row) {
  	$scope.tracks.splice($scope.tracks.indexOf(row),1);
  }
  $scope.addSong = function(row) {
  	$scope.tracks.splice($scope.tracks.indexOf(row),1);
  	$scope.tracks.push($scope.addedTracks);
 }
}]);

myApp.controller('collectionController', ['$scope', function($scope){
  $scope.addedTracks = [];
}]);

myApp.controller('sortController', ['$scope', function(){
  $scope.sortType = 'Artist'; // set the default sort type
  $scope.sortReverse = false; // set the default sort order 
}]);