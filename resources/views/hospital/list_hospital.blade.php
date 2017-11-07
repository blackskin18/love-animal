@extends('layouts.index')
@section('content')
    <div >
    <div class="" id="table-list-hostpital" ng-controller="listData" style="display: none; margin-top: 15px;">
        <table class="table table-bordered table-hover" ng-app>
            <thead>
               <tr>
                    <th ng-click="sort('id')" >Tên
                        <span class="glyphicon sort-icon" ng-show="sortKey=='id'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}" ></span>
                    </th>
                    <th ng-click="sort('address')" > Số điện thoại
                        <span class="glyphicon sort-icon" ng-show="sortKey=='address'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th>
                    <th ng-click="sort('status')" >Địa chỉ
                        <span class="glyphicon sort-icon" ng-show="sortKey=='status'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th> 
                    <th ng-click="sort('name')" > Ghi chú
                        <span class="glyphicon sort-icon" ng-show="sortKey=='name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th> 
                </tr>
            </thead>
            <tbody>
                <tr dir-paginate="hospital in hospitals|orderBy:sortKey:reverse|filter:search|itemsPerPage:7" ng-click="showDetailHospital(hospital)">
                    <td> <div style="height:100%;width:100%"><% hospital.name %> </div></a></td>
                    <td> <div style="height:100%;width:100%"><% hospital.phone %></div></a></td>
                    <td> <div style="height:100%;width:100%"><% hospital.address %></div></a></td>
                    <td> <div style="height:100%;width:100%"><% hospital.note %></div></a></td>
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
            $scope.showDetailHospital = function(hospital) {
               window.open(window.location.origin + "/" +"hospital/detail_info/" + hospital.id);
            };
            $scope.sort = function(keyname){
                $scope.sortKey = keyname;   //set the sortKey to the param passed
                $scope.reverse = !$scope.reverse; //if true make it false and vice versa
            }
        });
        $(function(){
            $('div#table-list-hostpital').css('display', 'block');
        });
    </script>
@endsection
