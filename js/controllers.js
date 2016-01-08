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

tracksController.controller('ListControllerJSONP', ['$scope', '$http', function($scope, $http) {
  $http.get('http://plansmash.com/soundtraxx/client/data/tracks.json').success(function(data) {
      $scope.tracks = data;
    });
  $scope.addedTracks = [];

  $scope.sortType = 'TopSong'; // set the default sort type
  $scope.sortReverse = true; // set the default sort order

}]);

tracksController.controller('ListController', ['$scope', '$http', function($scope, $http) {

	$http.get('./data/tracks.json').success(function(data) {
		$scope.tracks = data;
	});

	$scope.addedTracks = [];

	$scope.selectSong = function(songs) {

		$scope.addedTracks.push({
				Song : songs.Song,
				Artist : songs.Artist,
				ID : songs.ID,
				TopSong : songs.TopSong,
				Genre : songs.Genre
			});

		$scope.tracks.splice($scope.tracks.indexOf(songs),1);
	}

	$scope.removeSong = function(row) {

		$scope.addedTracks.splice($scope.addedTracks.indexOf(row),1);

		$scope.tracks.push({
				Song : row.Song,
				Artist : row.Artist,
				ID : row.ID,
				TopSong : row.TopSong,
				Genre : row.Genre
			});
		}

	$scope.clearSelectedSongs = function() {
		$scope.addedTracks = [];

		$http.get('./data/tracks.json').success(function(data) {
			$scope.tracks = data;
		});

	}

	$scope.sortType = 'TopSong'; // set the default sort type
	$scope.sortReverse = true; // set the default sort order

}]);
