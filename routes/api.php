<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\EnrollmentStatusController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\GradeStatusController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserStatusController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

Route::middleware('auth:sanctum')->group(function() {

    // Roles
    Route::get('/get-roles', [RoleController::class, 'getRoles']);
    Route::post('/add-role', [RoleController::class, 'addRole']);
    Route::put('/edit-role/{id}', [RoleController::class, 'editRole']);
    Route::delete('/delete-role/{id}', [RoleController::class, 'deleteRole']);

    // Profile
    Route::get('/get-profile', [ProfileController::class, 'getProfile']);
    Route::put('/edit-profile', [ProfileController::class, 'editProfile']);
    Route::put('/change-password', [ProfileController::class, 'changePassword']);

    // Student
    Route::get('/get-students', [StudentController::class, 'getStudents']);
    Route::post('/add-student', [StudentController::class, 'addStudent']);
    Route::put('/edit-student/{id}', [StudentController::class, 'editStudent']);
    Route::delete('/delete-student/{id}', [StudentController::class, 'deleteStudent']);

    // Enrollment
    Route::get('/get-enrollments', [EnrollmentController::class, 'getEnrollments']);
    Route::post('/add-enrollment', [EnrollmentController::class, 'addEnrollment']);
    Route::put('/edit-enrollment/{id}', [EnrollmentController::class, 'editEnrollment']);
    Route::delete('/delete-enrollment/{id}', [EnrollmentController::class, 'deleteEnrollment']);

    // Enrollment Status
    Route::get('/get-enrollment-statuses', [EnrollmentStatusController::class, 'getEnrollmentStatuses']);
    Route::post('/add-enrollment-status', [EnrollmentStatusController::class, 'addEnrollmentStatus']);
    Route::put('/edit-enrollment-status/{id}', [EnrollmentStatusController::class, 'editEnrollmentStatus']);
    Route::delete('/delete-enrollment-status/{id}', [EnrollmentStatusController::class, 'deleteEnrollmentStatus']);

    // Course
    Route::get('/get-courses', [CourseController::class, 'getCourses']);
    Route::post('/add-course', [CourseController::class, 'addCourse']);
    Route::put('/edit-course/{id}', [CourseController::class, 'editCourse']);
    Route::delete('/delete-course/{id}', [CourseController::class, 'deleteCourse']);

    // Grade
    Route::get('/get-grades', [GradeController::class, 'getGrades']);
    Route::post('/add-grade', [GradeController::class, 'addGrade']);
    Route::put('/edit-grade/{id}', [GradeController::class, 'editGrade']);
    Route::delete('/delete-grade/{id}', [GradeController::class, 'deleteGrade']);

    // Grade Status
    Route::get('/get-grade-statuses', [GradeStatusController::class, 'getGradeStatuses']);
    Route::post('/add-grade-status', [GradeStatusController::class, 'addGradeStatus']);
    Route::put('/edit-grade-status/{id}', [GradeStatusController::class, 'editGradeStatus']);
    Route::delete('/delete-grade-status/{id}', [GradeStatusController::class, 'deleteGradeStatus']);

    // Program
    Route::get('/get-programs', [ProgramController::class, 'getPrograms']);
    Route::post('/add-program', [ProgramController::class, 'addProgram']);
    Route::put('/edit-program/{id}', [ProgramController::class, 'editProgram']);
    Route::delete('/delete-program/{id}', [ProgramController::class, 'deleteProgram']);

    // User
    Route::get('/get-users', [UserController::class, 'getUsers']);
    Route::post('/add-user', [UserController::class, 'addUser']);
    Route::put('/edit-user/{id}', [UserController::class, 'editUser']);
    Route::delete('/delete-user/{id}', [UserController::class, 'deleteUser']);

    // User Status
    Route::get('/get-user-statuses', [UserStatusController::class, 'getUserStatuses']);
    Route::post('/add-user-status', [UserStatusController::class, 'addUserStatus']);
    Route::put('/edit-user-status/{id}', [UserStatusController::class, 'editUserStatus']);
    Route::delete('/delete-user-status/{id}', [UserStatusController::class, 'deleteUserStatus']);

    Route::post('/logout', [AuthenticationController::class, 'logout']);
});
