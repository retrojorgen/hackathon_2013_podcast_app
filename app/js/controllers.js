'use strict';

/* Controllers */

function PhoneListCtrl($scope, $http) {
  $http.get('http://localhost/podcast-app/backend/index.php').success(function(data) {
    $scope.phones = data;
    $scope.helpMessage = "";
    _.each($scope.phones, function(phone) {
      console.log(phone.date);
    });
  });
  $scope.helpMessage = "loading, yo";
  $scope.orderProp = 'date';
}
//PhoneListCtrl.$inject = ['$scope', '$http'];
