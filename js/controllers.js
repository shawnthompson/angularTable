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



/*
 angular.module('copyExample', [])
   .controller('ExampleController', ['$scope', function($scope) {
     $scope.master= {};

     $scope.update = function(user) {
       // Example with 1 argument
       $scope.master= angular.copy(user);
     };

     $scope.reset = function() {
       // Example with 2 arguments
       angular.copy($scope.master, $scope.user);
     };

     $scope.reset();
   }]);
*/

tracksController.controller('ListController', ['$scope', '$http', function($scope, $http) {
  $http.get('./data/tracks.json').success(function(data) {
      $scope.tracks = data; 
    });
  $scope.addedTracks = [ //sample data, to be removed before going live
    { 
      "ID":2,
      "Song":"YMCA",
      "Artist":"Village People",
      "Genre":"Disco",
      "TopSong":""
    }
  ];
  $scope.addSong = function(track) {
    $scope.addedTracks = angular.copy(track);
  }
  $scope.removeSong = function(row) {
    $scope.addedTracks.splice($scope.addedTracks.indexOf(row),1);
  }
  $scope.sortType = 'TopSong'; // set the default sort type
  $scope.sortReverse = false; // set the default sort order 
}]);

tracksController.controller('DetailsController', ['$scope', function($scope){
}]);

tracksController.controller('SortController', ['$scope', function(){
}]);