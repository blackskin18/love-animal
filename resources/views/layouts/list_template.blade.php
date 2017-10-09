@extends('layouts.index')

@section('content')
<div >
    <div class="table-list-animal" ng-controller="listData">
        <table class="table table-bordered" ng-app>
            <thead>
               <tr>
                    <th>
                        Ảnh
                    </th>
                    <th ng-click="sort('id')">Id
                        <span class="glyphicon sort-icon" ng-show="sortKey=='id'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th>
                    <th ng-click="sort('address')">địa điểm
                        <span class="glyphicon sort-icon" ng-show="sortKey=='address'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th>
                    <th ng-click="sort('status')">Tình trạng
                        <span class="glyphicon sort-icon" ng-show="sortKey=='status'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th> 
                    <th ng-click="sort('name')"> Trường hợp
                        <span class="glyphicon sort-icon" ng-show="sortKey=='name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th> <th ng-click="sort('created_at')"> ngày nhận
                        <span class="glyphicon sort-icon" ng-show="sortKey=='created_at'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th> <th ng-click="sort('updated_at')"> cập nhập lần cuối
                        <span class="glyphicon sort-icon" ng-show="sortKey=='updated_at'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th> 
                </tr>
            </thead>
            <tbody>
                <tr dir-paginate="animal in animals|orderBy:sortKey:reverse|filter:search|itemsPerPage:7" href="https://mp3.zing.vn/">
                    <td>
                        <a href="https://www.facebook.com"> <div style="height:100%;width:100%"><img src="{{ asset('animal_image/<% animal.id %>/<% animal.file_name %>') }}" alt="<% animal.description %>" width="75" height="50"></div></a>
                        
                    </td>
                    <td><a href="https://www.facebook.com"> <div style="height:100%;width:100%"><% animal.id %> </div></a></td>
                    <td><a href="https://www.facebook.com"> <div style="height:100%;width:100%"><% animal.address %></div></a></td>
                    <td><a href="https://www.facebook.com"> <div style="height:100%;width:100%"><% animal.status %></div></a></td>
                    <td><a href="https://www.facebook.com"> <div style="height:100%;width:100%"><% animal.name %></div></a></td>
                    <td><a href="https://www.facebook.com"> <div style="height:100%;width:100%"><% animal.created_at %></div></a></td>
                    <td><a href="https://www.facebook.com"> <div style="height:100%;width:100%"><% animal.  updated_at %></div></a></td>
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
        $(document).ready(function(){
            $('table tbody tr').click(function(){
                window.location = $(this).attr('href');
                return false;
            });
        });
    </script>
    @yield('api')
@endsection

