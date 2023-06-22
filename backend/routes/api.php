<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\Security\SecurityController;
use App\Http\Controllers\API\Security\RoleController;
use App\Http\Controllers\API\WorkingSecurityTeam\WorkingSecurityTeamController;
use App\Http\Controllers\API\Settings\WorkingSecurityTeamSettingController;
// use App\Http\Controllers\API\Visitor\RegistrationVisitorController;
use App\Http\Controllers\API\Visitor\VisitorCategoryController;
use App\Http\Controllers\API\Visitor\VisitorController;

use App\Http\Controllers\API\Income\IncomeVisitorController;
use App\Http\Controllers\API\Income\IncomeCarController;
use App\Http\Controllers\API\Income\IncomeAlarmController;
use App\Http\Controllers\API\Income\IncomeEventController;
use App\Http\Controllers\API\Income\IncomeFoggotenCardController;

use App\Http\Controllers\API\Income\SystemAlarmListController;
use App\Http\Controllers\API\People\EmployeeController;
use App\Http\Controllers\API\People\PositionController;
use App\Http\Controllers\API\Card\CardController;
use App\Http\Controllers\API\Report\ReportController;

use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\Devices\DeviceController;


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

  Route::get('get-current-user', [UserController::class, 'getCurrentUser']);
  Route::get('/user/list', [UserController::class, 'getUserList']);

  // Роуты категорий
  Route::resource('/positions', PositionController::class); //должности
  Route::resource('/security/roles', RoleController::class); // Роуты ролей сотрудников охраны

  // Роуты сотрудников охраны
  Route::resource('/securities', SecurityController::class);

  // Роуты создания рабочей смены охраны
  Route::get('/workingSecurityTeams/active', [WorkingSecurityTeamController::class, 'active']);
  Route::get('/workingSecurityTeams/last', [WorkingSecurityTeamController::class, 'last']);
  Route::resource('/workingSecurityTeams', WorkingSecurityTeamController::class);

  //Роуты настроек рабочей смены охраны
  Route::resource('/workingSecurityTeam/settings', WorkingSecurityTeamSettingController::class);

  // Роуты регистрации поситителей
  // Route::resource('/registrationVisitors', RegistrationVisitorController::class);
  Route::resource('/visitor/categories', VisitorCategoryController::class);
  Route::post('/incomeVisitor/in', [IncomeVisitorController::class, 'in']);
  Route::post('/incomeVisitor/out', [IncomeVisitorController::class, 'out']);
  Route::get('/incomeVisitor/onTerritory', [IncomeVisitorController::class, 'onTerritory']);
  Route::post('/visitor/searchBySurname', [VisitorController::class, 'searchBySurname']);

  // Регистрация автомобилей
  Route::post('/incomeCar/in', [IncomeCarController::class, 'in']);
  Route::post('/incomeCar/out', [IncomeCarController::class, 'out']);
  Route::get('/incomeCar/onTerritory', [IncomeCarController::class, 'onTerritory']);

  //Карты доступа
  Route::get('/card/index', [CardController::class, 'index']);
  Route::resource('/incomeFoggotenCard', IncomeFoggotenCardController::class);

  //Неисправности
  Route::get('/systemAlarmList', [SystemAlarmListController::class, 'index']);
  Route::resource('/incomeAlarm', IncomeAlarmController::class);
  Route::resource('/incomeEvent', IncomeEventController::class);
  Route::post('/incomeAlarm/close', [IncomeAlarmController::class, 'closeAlarm']);

  //Сотрудники
  Route::get('/employee', [EmployeeController::class, 'index']);
  Route::post('/employee/searchBySurname', [EmployeeController::class, 'searchBySurname']);

  //Отчеты
  Route::get('/report/byDay', [ReportController::class, 'byDay']);
  Route::get('/report/bySecurityTeam', [ReportController::class, 'bySecurityTeam']);
  Route::post('/report/byDuration', [ReportController::class, 'byDuration']);
  Route::get('/report/send-security-team-report', [ReportController::class, 'sendSecurityTeamReport']);

  //устройства
  Route::get('/device/getNetworkName', [DeviceController::class, 'getNetworkName']);
  Route::get('/device/getNetworkNameData', [DeviceController::class, 'getNetworkNameData']);
});
