//app.js
var myApp = angular.module('myApp', [
  'ngRoute',
  'tracksController'
]);

myApp.config(['$routeProvider', function($routeProvider){
  $routeProvider.
  when('/list', {
    templateURL: './partials/list.html',
    controller: 'ListController'
  }).
  otherwise({
    redirectTo: '/list'
  });
}]);