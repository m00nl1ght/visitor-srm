<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\Security\SecurityController;
use App\Http\Controllers\API\Security\SecurityTeamController;
use App\Http\Controllers\API\Security\RoleSecurityController;
use App\Http\Controllers\API\Settings\WorkingSecurityTeamSettingController;
use App\Http\Controllers\API\Visitor\VisitorCategoryController;
use App\Http\Controllers\API\Visitor\VisitorController;

use App\Http\Controllers\API\Income\IncomeVisitorController;
use App\Http\Controllers\API\Income\IncomeCarController;
use App\Http\Controllers\API\Income\IncomeAlarmController;
use App\Http\Controllers\API\Income\IncomeEventController;
use App\Http\Controllers\API\Income\IncomeFoggotenCardController;

use App\Http\Controllers\API\People\EmployeeController;
use App\Http\Controllers\API\People\PositionController;
use App\Http\Controllers\API\Card\CardController;
use App\Http\Controllers\API\Report\SecurityTeamReportController;

use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\Devices\DeviceController;
use App\Http\Controllers\API\Devices\DevicePermissionController;
use App\Http\Controllers\API\Roles\RoleController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//пользователи
Route::post('login', [LoginController::class, 'login']);
Route::post('registration', [RegistrationController::class, 'registration']);

Route::group(['middleware' => 'auth:sanctum'], function () {
  Route::post('logout', [LoginController::class, 'logout']);

  Route::get('/users/get-current', [UserController::class, 'getCurrentUser']);
  Route::post('/users/add-user-roles', [UserController::class, 'addUserRoles']);
  Route::resource('/users', UserController::class); //users

  // Роуты категорий
  Route::resource('/positions', PositionController::class); //должности
  Route::resource('/security/roles', RoleSecurityController::class); // Роуты ролей сотрудников охраны

  // Роуты сотрудников охраны
  Route::resource('/securities', SecurityController::class); //список сотрудников
  Route::get('/security-team/active', [SecurityTeamController::class, 'active']); //активная смена
  Route::resource('/security-team', SecurityTeamController::class); //рабочая группа

  //Роуты настроек рабочей смены охраны
  Route::resource('/workingSecurityTeam/settings', WorkingSecurityTeamSettingController::class);

  // Роуты регистрации поситителей
  // Route::resource('/registrationVisitors', RegistrationVisitorController::class);
  Route::resource('/visitor/categories', VisitorCategoryController::class);
  Route::post('/visitor/searchBySurname', [VisitorController::class, 'searchBySurname']);
  Route::post('/income-visitor/enter-territory', [IncomeVisitorController::class, 'enterTerritory']);
  Route::post('/income-visitor/leave-territory', [IncomeVisitorController::class, 'leaveTerritory']);
  Route::get('/income-visitor/onTerritory', [IncomeVisitorController::class, 'onTerritory']);

  // Регистрация автомобилей
  Route::post('/income-car/enter-territory', [IncomeCarController::class, 'enterTerritory']);
  Route::post('/income-car/leave-territory', [IncomeCarController::class, 'leaveTerritory']);
  Route::get('/income-car/on-territory', [IncomeCarController::class, 'onTerritory']);

  //Карты доступа
  Route::get('/card/index', [CardController::class, 'index']);
  Route::resource('/income-foggoten-card', IncomeFoggotenCardController::class);

  //Неисправности
  Route::get('/income-alarm/get-by-security-team', [IncomeAlarmController::class, 'getBySecurityTeam']);
  Route::post('/income-alarm/close', [IncomeAlarmController::class, 'closeAlarm']);
  Route::resource('/income-alarm', IncomeAlarmController::class);
  Route::resource('/income-event', IncomeEventController::class);

  //Сотрудники
  Route::get('/employee', [EmployeeController::class, 'index']);
  Route::post('/employee/searchBySurname', [EmployeeController::class, 'searchBySurname']);

  //Отчеты
  Route::get('/security-team-report/by-team', [SecurityTeamReportController::class, 'bySecurityTeam']);
  //old
  // Route::get('/report/byDay', [ReportController::class, 'byDay']);
  // Route::get('/report/bySecurityTeam', [ReportController::class, 'bySecurityTeam']);
  // Route::post('/report/byDuration', [ReportController::class, 'byDuration']);
  // Route::get('/report/send-security-team-report', [ReportController::class, 'sendSecurityTeamReport']);

  //устройства
  Route::get('/device/getNetworkName', [DeviceController::class, 'getNetworkName']);
  Route::get('/device/getNetworkNameData', [DeviceController::class, 'getNetworkNameData']);
  Route::resource('/device-permission', DevicePermissionController::class);
  Route::post('/device-permission/get-by-statuses', [DevicePermissionController::class, 'getListByStatuses']);
  Route::post('/device-permission/change-status', [DevicePermissionController::class, 'changeStatus']);

  //User roles
  Route::resource('/roles', RoleController::class);
});
