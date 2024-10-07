<?php


use App\Controller\ActivityController;
use App\Controller\AssociationController;
use App\Controller\AttendanceController;
use App\Controller\Auth\AuthController;
use App\Controller\Auth\LogoutController;
use App\Controller\CalendarController;
use App\Controller\CashRegisterController;
use App\Controller\CommitteeController;
use App\Controller\EventController;
use App\Controller\HomeController;
use App\Controller\MemberController;
use App\Controller\MemberUserController;
use App\Controller\OperationController;
use App\Controller\RegionController;
use App\Controller\ResponsibilityController;
use App\Controller\RoleController;
use App\Controller\SacramentController;
use App\Controller\StatisticController;
use App\Controller\TicketController;
use App\Controller\UpdateRoleAndResponsibility;
use App\Controller\UserCreateController;
use App\Controller\UserListController;
use App\Controller\UserResponsibilityHistoryController;
use App\Controller\UserSacramentController;
use App\Controller\UserUpdateController;
use App\Middleware\AuthMiddleware;

return [
    ['path' => "/auth/login", "method" => "POST", "controller" => [AuthController::class, "doLogin" ]],
    ['path' => "/", "method" => "GET", "controller" => [AuthController::class, "index"]],

    ['path' => "/logout", "method" => "POST", "controller" => [LogoutController::class, "index"]],

    ['path' => "/home", "method" => "GET", "controller" => [HomeController::class, "index"],  "middleware"=> [AuthMiddleware::class]],

    ['path' => "/regions", "method" => "GET", "controller" => [RegionController::class, "index"], "middleware"=> [AuthMiddleware::class]],
    ['path' => "/regions/update", "method" => "POST", "controller" => [RegionController::class, "update"]],
    ['path' => "/regions/create", "method" => "POST", "controller" => [RegionController::class, "create"]],
    ['path' => "/regions/delete", "method" => "POST", "controller" => [RegionController::class, "delete"]],

    ['path' => "/associations", "method" => "GET", "controller" => [AssociationController::class, "index"]],
    ['path' => "/associations/create", "method" => "POST", "controller" => [AssociationController::class, "create"]],
    ['path' => "/associations/update", "method" => "POST", "controller" => [AssociationController::class, "update"]],
    ['path' => "/associations/delete", "method" => "POST", "controller" => [AssociationController::class, "delete"]],

    ['path' => "/committees", "method" => "GET", "controller" => [CommitteeController::class, "index"]],
    ['path' => "/committees/create", "method" => "POST", "controller" => [CommitteeController::class, "create"]],
    ['path' => "/committees/update", "method" => "POST", "controller" => [CommitteeController::class, "update"]],
    ['path' => "/committees/delete", "method" => "POST", "controller" => [CommitteeController::class, "delete"]],

    ['path' => "/responsibilities", "method" => "GET", "controller" => [ResponsibilityController::class, "index"]],
    ['path' => "/responsibilities/create", "method" => "POST", "controller" => [ResponsibilityController::class, "create"]],
    ['path' => "/responsibilities/update", "method" => "POST", "controller" => [ResponsibilityController::class, "update"]],
    ['path' => "/responsibilities/delete", "method" => "POST", "controller" => [ResponsibilityController::class, "delete"]],

    ['path' => "/sacraments", "method" => "GET", "controller" => [SacramentController::class, "index"]],
    ['path' => "/sacraments/create", "method" => "POST", "controller" => [SacramentController::class, "create"]],
    ['path' => "/sacraments/update", "method" => "POST", "controller" => [SacramentController::class, "update"]],
    ['path' => "/sacraments/delete", "method" => "POST", "controller" => [SacramentController::class, "delete"]],

    ['path' => "/cash-registers", "method" => "GET", "controller" => [CashRegisterController::class, "index"]],
    ['path' => "/cash-registers/create", "method" => "POST", "controller" => [CashRegisterController::class, "create"]],
    ['path' => "/cash-registers/update", "method" => "POST", "controller" => [CashRegisterController::class, "update"]],
    ['path' => "/cash-registers/delete", "method" => "POST", "controller" => [CashRegisterController::class, "delete"]],

    ['path' => "/users", "method" => "GET", "controller" => [UserListController::class, "index"]],
    ['path' => "/user", "method" => "GET", "controller" => [UserListController::class, "find"]],

    ['path' => "/users/create/form", "method" => "GET", "controller" => [UserCreateController::class, "showForm"]],
    ['path' => "/users/create", "method" => "POST", "controller" => [UserCreateController::class, "create"]],

    ['path' => "/users/update/form", "method" => "GET", "controller" => [UserUpdateController::class, "showForm"]],
    ['path' => "/users/update", "method" => "POST", "controller" => [UserUpdateController::class, "update"]],

    ['path' => "/users/delete", "method" => "POST", "controller" => [UserListController::class, "delete"]],

    ['path' => "/members", "method" => "GET", "controller" => [MemberController::class, "index"]],
    ['path' => "/members/create", "method" => "POST", "controller" => [MemberController::class, "create"]],
    ['path' => "/members/update", "method" => "POST", "controller" => [MemberController::class, "update"]],
    ['path' => "/members/delete", "method" => "POST", "controller" => [MemberController::class, "delete"]],

    ['path' => "/activities", "method" => "GET", "controller" => [ActivityController::class, "index"]],
    ['path' => "/activities/create", "method" => "POST", "controller" => [ActivityController::class, "create"]],
    ['path' => "/activities/update", "method" => "POST", "controller" => [ActivityController::class, "update"]],
    ['path' => "/activities/delete", "method" => "POST", "controller" => [ActivityController::class, "delete"]],

    ['path' => "/member_users", "method" => "GET", "controller" => [MemberUserController::class, "index"]],
    ['path' => "/member_users/attach", "method" => "POST", "controller" => [MemberUserController::class, "create"]],
    ['path' => "/member_users/detach", "method" => "POST", "controller" => [MemberUserController::class, "delete"]],


    ['path' => "/user-sacraments", "method" => "GET", "controller" => [UserSacramentController::class, "index"]],
    ['path' => "/user-sacraments/attach", "method" => "POST", "controller" => [UserSacramentController::class, "attach"]],
    ['path' => "/user-sacraments/detach", "method" => "POST", "controller" => [UserSacramentController::class, "detach"]],

    ['path' => "/attendances", "method" => "GET", "controller" => [AttendanceController::class, "index"]],
    ['path' => "/attendances/mark", "method" => "POST", "controller" => [AttendanceController::class, "create"]],
    ['path' => "/attendances/update", "method" => "POST", "controller" => [AttendanceController::class, "update"]],
    ['path' => "/attendances/remove", "method" => "POST", "controller" => [AttendanceController::class, "remove"]],

    ['path' => "/operations", "method" => "GET", "controller" => [OperationController::class, "index"]],
    ['path' => "/operations/create", "method" => "POST", "controller" => [OperationController::class, "create"]],
    ['path' => "/operations/update", "method" => "POST", "controller" => [OperationController::class, "update"]],
    ['path' => "/operations/delete", "method" => "POST", "controller" => [OperationController::class, "delete"]],

    ['path' => "/tickets", "method" => "GET", "controller" => [TicketController::class, "index"]],
    ['path' => "/tickets/create", "method" => "POST", "controller" => [TicketController::class, "create"]],
    ['path' => "/tickets/update", "method" => "POST", "controller" => [TicketController::class, "update"]],
    ['path' => "/tickets/delete", "method" => "POST", "controller" => [TicketController::class, "delete"]],

    ['path' => "/events", "method" => "GET", "controller" => [EventController::class, "index"]],
    ['path' => "/events/create", "method" => "POST", "controller" => [EventController::class, "create"]],
    ['path' => "/events/update", "method" => "POST", "controller" => [EventController::class, "update"]],
    ['path' => "/events/delete", "method" => "POST", "controller" => [EventController::class, "delete"]],

    ['path' => "/calendars", "method" => "GET", "controller" => [CalendarController::class, "index"]],
    ['path' => "/api/activities", "method" => "GET", "controller" => [CalendarController::class, "getAllActivities"]],
    ['path' => "/api/activity_details", "method" => "GET", "controller" => [CalendarController::class, "getActivityDetailsById"]],

    ['path' => "/roles", "method" => "GET", "controller" => [RoleController::class, "index"]],
    ['path' => "/roles/create", "method" => "POST", "controller" => [RoleController::class, "create"]],
    ['path' => "/roles/update", "method" => "POST", "controller" => [RoleController::class, "update"]],
    ['path' => "/roles/delete", "method" => "POST", "controller" => [RoleController::class, "delete"]],

    ['path' => "/user-responsibilities", "method" => "GET", "controller" => [UserResponsibilityHistoryController::class, "index"]],

    ['path' => "/users/responsibilities/update", "method" => "POST", "controller" => [UpdateRoleAndResponsibility::class, "updateResponsibility"]],
    ['path' => "/users/responsibilities/form", "method" => "GET", "controller" => [UpdateRoleAndResponsibility::class, "showUpdateResponsibility"]],

    ['path' => "/roles/users/update", "method" => "POST", "controller" => [UpdateRoleAndResponsibility::class, "updateRole"]],
    ['path' => "/roles/form", "method" => "GET", "controller" => [UpdateRoleAndResponsibility::class, "showUpdateRole"]],
    ['path' => "/statistics", "method" => "GET", "controller" => [StatisticController::class, "index"]],

    ['path' => "/api/member-counts", "method" => "GET", "controller" => [StatisticController::class, "getMemberCountByYear"]],
    ['path' => "/api/sex-year", "method" => "GET", "controller" => [StatisticController::class, "getSexByYear"]],
    ['path' => "/api/sacrament-year", "method" => "GET", "controller" => [StatisticController::class, "getSacramentByYear"]],
    ['path' => "/api/activity-month", "method" => "GET", "controller" => [StatisticController::class, "getActivityByMonth"]],
    ['path' => "/api/budget-month", "method" => "GET", "controller" => [StatisticController::class, "getBudgetByMonth"]],
    ['path' => "/api/budget-year", "method" => "GET", "controller" => [StatisticController::class, "getBudgetByYear"]],
];
