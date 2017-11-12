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
                    <th ng-click="sort('name')" ng-if="level < 4" > Xóa
                        <span class="glyphicon sort-icon" ng-show="sortKey=='name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th> 
                </tr>
            </thead>
            <tbody>
                <tr dir-paginate="hospital in hospitals|orderBy:sortKey:reverse|filter:search|itemsPerPage:7" >
                    <td ng-click="showDetailHospital(hospital)"> <div style="height:100%;width:100%"><% hospital.name %> </div></a></td>
                    <td ng-click="showDetailHospital(hospital)"> <div style="height:100%;width:100%"><% hospital.phone %></div></a></td>
                    <td ng-click="showDetailHospital(hospital)"> <div style="height:100%;width:100%"><% hospital.address %></div></a></td>
                    <td ng-click="showDetailHospital(hospital)"> <div style="height:100%;width:100%"><% hospital.note %></div></a></td>
                    <td ng-if="level < 4">
                        <input type="button" value="Xóa" class="btn btn-primary" ng-click="removeRow(hospital)"/>
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

        app.controller('listData', function($scope, $http) {
            $http.get("/api/get_list_hospital")
            .then(function(response) {
                console.log(response.data.hospitals);
                $scope.hospitals = response.data.hospitals;
                $scope.level = response.data.user_level;
                console.log($scope.hospitals.hospitals);
            });
            $scope.showDetailHospital = function(hospital) {
               window.open(window.location.origin + "/" +"hospital/detail_info/" + hospital.id);
            };

            $scope.removeRow = function(hospital){
                let hospitalId = hospital.id;
                let index = -1;     
                let hospitalArr = eval( $scope.hospitals );
                for( var i = 0; i < hospitalArr.length; i++ ) {
                    if( hospitalArr[i].id === hospitalId ) {
                        index = i;
                        break;
                    }
                }
                if( index === -1 ) {
                    alert( "Something gone wrong" );
                }
                let agree =confirm("Bạn có muốn xóa bệnh viện: " + hospital.name +"?\nSau khi xóa, không thể khôi phục lại dữ liệu của bệnh viện này");
                if(agree){
                    $http.get("/api/delete_hospital/"+hospitalId)
                    .then(function successCallback(data){
                        $scope.hospitals.splice( index, 1 );
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
            $('div#table-list-hostpital').css('display', 'block');
        });
    </script>
@endsection
