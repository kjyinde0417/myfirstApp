<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\VisionApiTest;
class VisionApiController extends Controller
{

    //Api呼び出し
    public function callApi() {
    $api = new VisionApiTest();
    $resultFromPics = $api->CallVisionApi();
    var_dump($resultFromPics);
    }


    /*
     * public function CallTestApi () {
     *
     * $result = $api-> testMethod();
     * return view('things', $result;
     *
     */
}
