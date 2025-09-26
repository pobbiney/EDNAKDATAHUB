<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\AuthenticationController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\UserManagement\UserManagementController;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Setup\SetupController;

Route::get('/',[AuthenticationController::class,'index']);
Route::get('login',[AuthenticationController::class,'index'])->name('login');

Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');

/* Authentication */ 

Route::post('authentication-process',[AuthenticationController::class,'authenticationProcess'])->name('authentication-process');
Route::post('logout-authentication-process',[DashboardController::class,'logoutAuthenticationProcess'])->name('logout-authentication-process');


/* User Management */ 

Route::get('user-management-add-category',[UserManagementController::class,'userCategoryView'])->name('user-management-add-category');
Route::post('user-management-add-category-process',[UserManagementController::class,'userCategoryProcess'])->name('user-management-add-category-process');
Route::get('user-management-add-category-edit/{id}',[UserManagementController::class,'editUserCategoryView'])->name('user-management-add-category-edit');
Route::post('user-management-add-category-edit-process/{id}',[UserManagementController::class,'editUserCategoryProcess'])->name('user-management-add-category-edit-process');

Route::get('user-management-privilege',[UserManagementController::class,'assignUserPrivilegesView'])->name('user-management-privilege');
Route::post('get-category-privileges',[UserManagementController::class,'getUserPrivileges'])->name('get-category-privileges');
Route::post('save-user-privileges',[UserManagementController::class,'saveUserPrivileges'])->name('save-user-privileges');

Route::get('user-management-create-account',[UserManagementController::class,'createAccountUser'])->name('user-management-create-account');
Route::post('get-user-email-process',[UserManagementController::class,'getAccountEmail']);
Route::post('create-account-process',[UserManagementController::class,'createAccount'])->name('create-account-process');

Route::get('user-management-list-create-account',[UserManagementController::class,'listAccountsView'])->name('user-management-list-create-account');
Route::any('user-management-get-accounts',[UserManagementController::class,'getUserAccountList'])->name('user-management-get-accounts');

Route::get('user-management-edit-user-account/{id}',[UserManagementController::class,'editUserAccountView'])->name('user-management-edit-user-account');
Route::post('user-management-edit-user-account-process/{id}',[UserManagementController::class,'editUserAccountProcess'])->name('user-management-edit-user-account-process');

/* End User Management */ 

/*Staff Management */
Route::get('create-staff',[StaffController::class,'addStaff'])->name('create-staff');
Route::post('create-staff-process',[StaffController::class,'saveStaff'])->name('create-staff-process');
Route::get('edit-staff/{staff_id}',[StaffController::class,'editStaffView'])->name('edit-staff');
Route::post('edit-staff-process/{staff_id}',[StaffController::class,'ediStaff'])->name('edit-staff-process');
/*Staff Management*/

/*Setup  */
Route::get('ServiceProvider',[SetupController::class,'viewServiceProvider'])->name('ServiceProvider');
Route::post('add-service-provider-process',[SetupController::class,'addServiceProvider'])->name('add-service-provider-process');
Route::get('edit-ServiceProvider/{id}',[SetupController::class,'viewEditServiceProvider'])->name('edit-ServiceProvider');
Route::post('edit-service-provider-process/{id}',[SetupController::class,'editServiceProvider'])->name('edit-service-provider-process');
Route::get('Packages',[SetupController::class,'packagesView'])->name('Packages');
Route::get('service-provider-id/{id}',[SetupController::class,'getServiceProvidersID'])->name('service-provider-id');
Route::post('add-packages-process',[SetupController::class,'addPackages'])->name('add-packages-process');
Route::post('add-agent-packages-process',[SetupController::class,'addAgentPackages'])->name('add-agent-packages-process');
Route::post('edit-packages-process',[SetupController::class,'editPackages'])->name('edit-packages-process');
Route::post('edit-agent-packages-process',[SetupController::class,'editAgentPackages'])->name('edit-agent-packages-process');
Route::get('package-id/{id}',[SetupController::class,'getPackageID'])->name('package-id');
Route::get('agent-package-id/{id}',[SetupController::class,'getAgentPackageID'])->name('agent-package-id');
Route::get('Packages/{id}/delete', [SetupController::class, 'destroy']) ;
Route::get('AgentPackage',[SetupController::class,'viewAgentPackage'])->name('AgentPackage');
Route::get('Agent-Packages/{id}/delete', [SetupController::class, 'destroyagent']) ;
Route::post('add-agent-plan-process',[SetupController::class,'addAgentPlan'])->name('add-agent-plan-process');

Route::post('edit-agentplan-process/{id}',[SetupController::class,'editAgentPlan'])->name('edit-agentplan-process');
Route::get('edit-agentplan/{id}',[SetupController::class,'editAgentPlanView'])->name('edit-agentplan');

Route::get('AgentPlan',[SetupController::class,'viewAgentPlan'])->name('AgentPlan');

/*End Setup*/