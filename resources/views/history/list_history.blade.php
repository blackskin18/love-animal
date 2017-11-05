@extends('layouts.index')
@section('link-css')
@endsection
@section('content')
    <div >
    <div class="container" id="table-list-history" ng-controller="listData" style="display: none; margin-top: 15px;">
        <table class="table table-bordered table-hover" ng-app>
            <thead>
               <tr>
                    <th ng-click="sort('date')" > Ngày thay đổi
                        <span class="glyphicon sort-icon" ng-show="sortKey=='date'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th>
                    <th ng-click="sort('user')" >
                        Người Dùng
                        <span class="glyphicon sort-icon" ng-show="sortKey=='user'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}" ></span>
                    </th>
                    <th ng-click="sort('case')" > Case
                        <span class="glyphicon sort-icon" ng-show="sortKey=='case'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th>
                    <th ng-click="sort('note')" > Ghi Chú
                        <span class="glyphicon sort-icon" ng-show="sortKey=='note'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th> 
                    <th ng-click="sort('old_value')" > Trước khi thay Đổi
                        <span class="glyphicon sort-icon" ng-show="sortKey=='old_value'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th> 
                    <th ng-click="sort('new_value')" > Sau khi thay đổi
                        <span class="glyphicon sort-icon" ng-show="sortKey=='new_value'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th>

                </tr>
            </thead>
            <tbody>
                <tr dir-paginate="history in histories|orderBy:sortKey:reverse|filter:search|itemsPerPage:7" ng-click="showVolunteer(volunteer)">
                    <td><div style="height:100%;width:100%"><% history.created_at %> </div></td>
                    <td>
                        <a href="/volunteer/info/<% history.user_id %>">
                            <div style="height:100%;width:100%">
                                <% history.user.name %>
                            </div>
                        </a>
                    </td>
                    <td> 
                        <a href="/animal/detail_info/<% history.animal_id %>">
                            <div style="height:100%;width:100%">
                                <% history.animal_id %>
                            </div>
                        </a>
                    </td>
                    <td> <div style="height:100%;width:100%"><% history.note %></div></td>
                    <td>
                        <div ng-if="history.attribute == 'image'" class="text-center" style="height:100%;width:100%">
                            <img src="{{ asset('animal_image') }}/<% history.animal_id %>/<% history.old_value %>"  width="75" height="50" alt="">
                            </div>
                        <div ng-if="history.attribute != 'image'" style="height:100%;width:100%"><% history.old_value %></div>
                    </td>
                    <td> 
                        <div ng-if="history.attribute == 'image'" class="text-center" style="height:100%;width:100%">
                            <img src="{{ asset('animal_image') }}/<% history.animal_id %>/<% history.new_value %>"  width="75" height="50" alt="">
                            </div>
                        <div ng-if="history.attribute != 'image'" style="height:100%;width:100%"><% history.new_value %></div>
                    </td>
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
            $http.get("/api/get_data/histories")
            .then(function(response) {
                console.log(response.data);
                $scope.histories = response.data;
            });

            // $scope.showVolunteer = function(volunteer) {
            //    location.href = window.location.origin + "/" +"volunteer/info/" + volunteer.id;
            // };

            $scope.sort = function(keyname){
                $scope.sortKey = keyname;   //set the sortKey to the param passed
                $scope.reverse = !$scope.reverse; //if true make it false and vice versa
            }
        });
        $(function(){
            $('div#table-list-history').css('display', 'block');
        });
    </script>
    <script>
        
    </script>
@endsection