@extends('layouts.list_template')
@section('api')
    <script>
        app.controller('listData', function($scope, $http) {
            $scope.name = "Volvo";
            $http.get("/post-list-pet")
            .then(function(response) {
                console.log(response.data);
                $scope.animals = response.data;
            });
            $scope.showDetailAnimal = function(animal) {
               location.href = window.location.origin + "/" +"animal/detail_info/" + animal.id;
            };
            $scope.sort = function(keyname){
                $scope.sortKey = keyname;   //set the sortKey to the param passed
                $scope.reverse = !$scope.reverse; //if true make it false and vice versa
            }
        });
        $('div#table-list-animal').css('display', 'block');
        
    </script>
@endsection