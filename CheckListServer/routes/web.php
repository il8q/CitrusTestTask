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

Route::get('/autorizate', function (Request $request) {
    $domain = getDomainInstance();
    $response = $domain->autorizate(
        $request->query('email'),
        $request->query('password')
    );
    return $response;
});
    
Route::get('/register', function (Request $request) {
    $domain = getDomainInstance();
    $response = $domain->register(
        $request->query('email'), 
        $request->query('password')
    );
    return $response;
});
  
Route::get('/get-check-lists', function (Request $request) {
    $domain = getDomainInstance();
    $response = $domain->getCheckListsInShortForm();
    return $response;
});
    
Route::get('/get-points', function (Request $request) {
    $domain = getDomainInstance();
    $checkListId = intval($request->query('check-list-id'));
    $response = $domain->getPoints($checkListId);
    return $response;
});
