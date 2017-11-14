@extends('layouts.index')
@section('content')
    <div >
    <div class="" id="table-list-volunteer" ng-controller="listData" style="display: none">
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
                    <th>
                        Xóa
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr dir-paginate="volunteer in volunteers|orderBy:sortKey:reverse|filter:search|itemsPerPage:7" >
                    <td ng-click="showVolunteer(volunteer)"><div style="height:100%;width:100%"><% volunteer.name %> </div></td>
                    <td ng-click="showVolunteer(volunteer)"> <div style="height:100%;width:100%"><% volunteer.phone %></div></td>
                    <td ng-click="showVolunteer(volunteer)"> <div style="height:100%;width:100%"><% volunteer.address %></div></td>
                    <td ng-click="showVolunteer(volunteer)"> <div style="height:100%;width:100%"><% volunteer.note %></div></td>
                    <td ng-if="level < 4">
                        <input type="button" value="Xóa" class="btn btn-primary" ng-click="removeRow(volunteer)"/>
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
            $http.get("/api/get_list_volunteer")
            .then(function(response) {
                console.log(response.data.volunteers);
                $scope.volunteers = response.data.volunteers;
                $scope.level = response.data.user_level;
            });

            $scope.showVolunteer = function(volunteer) {
               location.href = window.location.origin + "/" +"volunteer/info/" + volunteer.id;
            };

            $scope.removeRow = function(volunteer){
                let volunteerId = volunteer.id;
                let index = -1;     
                let volunteerArr = eval( $scope.volunteers );
                for( var i = 0; i < volunteerArr.length; i++ ) {
                    if( volunteerArr[i].id === volunteerId ) {
                        index = i;
                        break;
                    }
                }
                if( index === -1 ) {
                    alert( "Something gone wrong" );
                }
                let agree =confirm("Bạn có muốn xóa bệnh viện: " + volunteer.name +"?\nSau khi xóa, không thể khôi phục lại dữ liệu của bệnh viện này");
                if(agree){
                    $http.get("/api/delete_volunteer/"+volunteerId)
                    .then(function successCallback(data){
                        $scope.volunteers.splice( index, 1 );
                        alert('Xóa thành công')
                    }, function errorCallback(data){
                        alert('Không thể xóa bệnh viện này');                        
                    });
                }
            }


            $scope.sort = function(keyname){
                $scope.sortKey = keyname;   //set the sortKey to the param passed
                $scope.reverse = !$scope.reverse; //if true make it false and vice versa
            }
        });
        $(function(){
            $('div#table-list-volunteer').css('display', 'block');
        });
    </script>
    <script>
        
    </script>
@endsection
