// controllers.js
var tracksController = angular.module('tracksController', ['angularUtils.directives.dirPagination'])

tracksController.filter('unique', function () {
return function ( collection, keyname) {
var output = [],
    keys = []
    found = [];

if (!keyname) {

    angular.forEach(collection, function (row) {
        var is_found = false;
        angular.forEach(found, function (foundRow) {

            if (foundRow == row) {
                is_found = true;                            
            }
        });

        if (is_found) { return; }
        found.push(row);
        output.push(row);

    });
}
else {

    angular.forEach(collection, function (row) {
        var item = row[keyname];
        if (item === null || item === undefined) return;
        if (keys.indexOf(item) === -1) {
            keys.push(item);
            output.push(row);
        }
    });
}

return output;
};
});


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

tracksController.controller('DetailsController', ['$scope', function($scope){
  $scope.addedTracks = [];
}]);

tracksController.controller('SortController', ['$scope', function(){
  $scope.sortType = 'Artist'; // set the default sort type
  $scope.sortReverse = false; // set the default sort order 
}]);