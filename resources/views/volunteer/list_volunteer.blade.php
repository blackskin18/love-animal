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
                    <th ng-click="sort('status')" width="25%">Địa điểm
                        <span class="glyphicon sort-icon" ng-show="sortKey=='status'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th> 
                    <th ng-click="sort('name')" width="25%"> Ghi chú
                        <span class="glyphicon sort-icon" ng-show="sortKey=='name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th> 
                </tr>
            </thead>
            <tbody>
                <tr dir-paginate="volunteer in volunteers|orderBy:sortKey:reverse|filter:search|itemsPerPage:7" ng-click="showVolunteer(volunteer)">
                    <td><div style="height:100%;width:100%"><% volunteer.name %> </div></td>
                    <td> <div style="height:100%;width:100%"><% volunteer.phone %></div></td>
                    <td> <div style="height:100%;width:100%"><% volunteer.address %></div></td>
                    <td> <div style="height:100%;width:100%"><% volunteer.note %></div></td>
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

        app.controller('listData', function($scope, $http, $location) {
            $http.get("/api/get_list_volunteer")
            .then(function(response) {
                console.log(response.data);
                $scope.volunteers = response.data;
            });

            $scope.showVolunteer = function(volunteer) {
               location.href = window.location.origin + "/" +"volunteer/info/" + volunteer.id;
            };

            $scope.sort = function(keyname){
                $scope.sortKey = keyname;   //set the sortKey to the param passed
                $scope.reverse = !$scope.reverse; //if true make it false and vice versa
            }
        });
    </script>
    <script>
        
    </script>
@endsection
