<?php

use App\User;
use App\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

Route::get('/users', function (Request $request) {
    
    $skillJson = Utils::getQueryGroupConcat([
        'skill' => "skills.skill"
    ], true);
    $educationsJson = Utils::getQueryGroupConcat([
        'degree' => 'education.degree',
        'start_year' => 'education.start_year',
        'end_year' => 'education.end_year',
        'school' => 'education.school',
        'description' => 'education.description',
    ], true);
    $experiencesJson = Utils::getQueryGroupConcat([
        'title' => 'experiences.title',
        'employment_type' => 'experiences.employment_type',
        'company' => 'experiences.company',
        'description' => 'experiences.description',
    ], true);
    $certificatesJson = Utils::getQueryGroupConcat([
        'title' => 'certificates.title',
        'organization' => 'certificates.organization',
        'certificate_id' => 'certificates.certificate_id',
    ], true);

    $users = User::select([
        'users.id',
        'users.name',
        'users.email',
        DB::raw($skillJson. ' as skills'),
        DB::raw($educationsJson. ' as educations'),
        DB::raw($certificatesJson. ' as certificates'),
        DB::raw($experiencesJson. ' as experiences')
    ]);

    $users = $users->leftJoin('skills', 'skills.user_id', '=', 'users.id');
    $users = $users->leftJoin('education', 'education.user_id', '=', 'users.id');
    $users = $users->leftJoin('experiences', 'experiences.user_id', '=', 'users.id');
    $users = $users->leftJoin('certificates', 'certificates.user_id', '=', 'users.id');

    $users = $users->groupBy('users.id')->get()->toArray();

    $users = array_map(function($user){
        $user['skills'] = !empty($user['skills']) ? json_decode($user['skills'], true) : [];
        $user['skills'] = array_map(function($val){return $val['skill'];}, $user['skills']);
        
        $user['educations'] = !empty($user['educations']) ? json_decode($user['educations'], true) : [];
        $user['experiences'] = !empty($user['experiences']) ? json_decode($user['experiences'], true) : [];
        $user['certificates'] = !empty($user['certificates']) ? json_decode($user['certificates'], true) : [];

        return $user;
    }, $users);

    return response()->json($users);
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
