@extends('layouts.list_template')
@section('api')
    <script>
        app.controller('listData', function($scope, $http) {
            $scope.name = "Volvo";
            $http.get("/api/animal/list_die")
            .then(function(response) {
                var parsed = response.data;
                var arr = [];
                for(var x in parsed){
                    arr.push(parsed[x]);
                }
                $scope.animals = arr;
            });
            $scope.showDetailAnimal = function(animal) {
               window.open(window.location.origin + "/" +"animal/detail_info/" + animal.id);
                
            };
            $scope.sort = function(keyname){
                $scope.sortKey = keyname;   //set the sortKey to the param passed
                $scope.reverse = !$scope.reverse; //if true make it false and vice versa
            }
        });
        $(function(){
            $('div#table-list-animal').css('display', 'block');
        });
    </script>
@endsection