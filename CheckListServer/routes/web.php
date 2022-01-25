<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Src\DomainModel\DomainModelFacade;
use Src\DomainModel\DomainModelFacadeBuilderDirector;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$GLOBALS['domainModelIsInit'] = false;
function getDomainInstance()
{
    if (!$GLOBALS['domainModelIsInit']) {
        $GLOBALS['domainModelIsInit'] = true;
        $domainFacadeBuilder = new DomainModelFacadeBuilderDirector();
        $GLOBALS['domain'] = $domainFacadeBuilder->create();
    }
    return $GLOBALS['domain'];
}


Route::get('/', function () {
    return view('welcome');
});

Route::post('/autorizate', function (Request $request) {
    $domain = getDomainInstance();
    $response = $domain->autorizate(
        $request->input('email'),
        $request->input('password')
    );
    return Response::json($response, 200);
});
    
Route::post('/register', function (Request $request) {
    $domain = getDomainInstance();
    $response = $domain->register(
        $request->input['email'],
        $request->input['password']
    );
    return Response::json($response, 200);
});
  
Route::get('/get-check-lists', function (Request $request) {
    $domain = getDomainInstance();
    $response = $domain->getCheckListsInShortForm();
    return Response::json($response, 200);
});
    
Route::get('/get-points', function (Request $request) {
    $domain = getDomainInstance();
    $checkListId = intval($request->query('check-list-id'));
    $response = $domain->getPoints($checkListId);
    return Response::json($response, 200);
});
