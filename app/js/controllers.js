'use strict';

/* Controllers */

function PhoneListCtrl($scope, $http) {
  $http.get('http://localhost/podcast-app/backend/index.php').success(function(data) {
    $scope.phones = data;
  });
  $scope.helpMessage = "loading, yo";
  $scope.predicate = '-date';
}
//PhoneListCtrl.$inject = ['$scope', '$http'];

var dateFromMySQLTimestamp = function (mySQLTimestampString) {
  mySQLTimestampString = mySQLTimestampString.split(/[- :]/);
  return new Date(mySQLTimestampString[0], mySQLTimestampString[1]-1, mySQLTimestampString[2], mySQLTimestampString[3], mySQLTimestampString[4], mySQLTimestampString[5]);
}