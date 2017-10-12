@extends('layouts.list_template')
@section('api')
    <script>
        app.controller('listData', function($scope, $http) {
            $scope.name = "Volvo";
            $http.get("/api/animal/list_ready_to_find_the_owner")
            .then(function(response) {
                console.log(response);
                $scope.animals = response.data;
            });
            $scope.sort = function(keyname){
                $scope.sortKey = keyname;   //set the sortKey to the param passed
                $scope.reverse = !$scope.reverse; //if true make it false and vice versa
            }
        });
    </script>
@endsection