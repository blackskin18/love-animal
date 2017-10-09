@extends('layouts.index')
@section('content')
    <div >
    <div class="container" ng-controller="listData" style="margin-top: 15px;">
        <table class="table table-bordered table-hover" ng-app>
            <thead>
               <tr>
                    <th ng-click="sort('id')" width="25%">Tên
                        <span class="glyphicon sort-icon" ng-show="sortKey=='id'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}" ></span>
                    </th>
                    <th ng-click="sort('address')" width="25%"> Số điện thoại
                        <span class="glyphicon sort-icon" ng-show="sortKey=='address'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th>
                    <th ng-click="sort('status')" width="25%">Địa chỉ
                        <span class="glyphicon sort-icon" ng-show="sortKey=='status'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th> 
                    <th ng-click="sort('name')" width="25%"> Ghi chú
                        <span class="glyphicon sort-icon" ng-show="sortKey=='name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th> 
                </tr>
            </thead>
            <tbody>
                <tr dir-paginate="hospital in hospitals|orderBy:sortKey:reverse|filter:search|itemsPerPage:7">
                    <td><a href="https://www.facebook.com"> <div style="height:100%;width:100%"><% hospital.name %> </div></a></td>
                    <td><a href="https://www.facebook.com"> <div style="height:100%;width:100%"><% hospital.phone %></div></a></td>
                    <td><a href="https://www.facebook.com"> <div style="height:100%;width:100%"><% hospital.address %></div></a></td>
                    <td><a href="https://www.facebook.com"> <div style="height:100%;width:100%"><% hospital.note %></div></a></td>
                </tr>
            </tbody>
        </table>
        <div style="margin:auto; width:60%;">
            <dir-pagination-controls
                max-size="10"
                direction-links="true"
                boundary-links="true">
            </dir-pagination-controls>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        var app = angular.module('pagination', ['angularUtils.directives.dirPagination'], function($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        });

        app.controller('listData', function($scope, $http) {
            $http.get("/api/get_list_hospital")
            .then(function(response) {
                console.log(response.data);
                $scope.hospitals = response.data;
                console.log($scope.hospitals);
            });
            $scope.sort = function(keyname){
                $scope.sortKey = keyname;   //set the sortKey to the param passed
                $scope.reverse = !$scope.reverse; //if true make it false and vice versa
            }
        });
    </script>
@endsection
