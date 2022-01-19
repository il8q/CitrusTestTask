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
function initDomainIfNotInit()
{
    if (!$GLOBALS['domainModelIsInit']) {
        $GLOBALS['domainModelIsInit'] = true;
        $domainFacadeBuilder = new DomainModelFacadeBuilderDirector();
        $GLOBALS['domain'] = $domainFacadeBuilder->create();
    }
}


Route::get('/', function () {
    return view('welcome');
});

    
Route::get('/register', function (Request $request) {
    initDomainIfNotInit();
    $domain = $GLOBALS['domain'];
    $message = $domain->register(
        $request->query('email'), 
        $request->query('password')
    );
    return $message;
});
