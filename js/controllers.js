// controllers.js
var tracksController = angular.module('tracksController', ['angularUtils.directives.dirPagination'])

tracksController.controller('ListController', ['$scope', '$http', function($scope, $http) {
  $http.get('./data/tracks.json').success(function(data) {
      $scope.tracks = data; 
    });
  $scope.removeSong = function(row) {
  	$scope.tracks.splice($scope.tracks.indexOf(row),1);
  }
  $scope.addSong = function(row) {
  	$scope.tracks.splice($scope.tracks.indexOf(row),1);
  	$scope.tracks.push($scope.addedTracks);
  }
}]);

tracksController.controller('CollectionController', ['$scope', function($scope){
  $scope.addedTracks = [];
}]);

tracksController.controller('SortController', ['$scope', function(){
  $scope.sortType = 'Artist'; // set the default sort type
  $scope.sortReverse = false; // set the default sort order 
}]);