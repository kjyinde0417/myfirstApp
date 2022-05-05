<?php
namespace App\Providers;
//authエラー回避に変数を書いておく putenv('GOOGLE_APPLICATION_CREDENTIALS='.__DIR__ . '/xxxxx.json'); require_once ( __DIR__ . '/vendor/autoload.php');
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
$curl = curl_init();
class VisionApiTest
{

   public function CallVisionApi() {

// APIキー
       $api_key = "AIzaSyA05VK7U-4NIYHabJhzplumvQZ641POGhU" ;

//画像のPATHを入力してください（URLでいいですよ）
       $image_path = "https://book.mynavi.jp/files/user/manatee/rensai/013_TensorFlow/00/015.jpg";

// リクエスト用のJSONを作成
       $json = json_encode( array(
           "requests" => array(
               array(
                   "image" => array(
                       "content" => base64_encode( file_get_contents( $image_path ) ) ,
                   ) ,
                   "features" => array(
                       array(
                           "type" => "TEXT_DETECTION" ,
                           "maxResults" => 10 ,
                       ) ,
                   ) ,
               ) ,
           ) ,
       ) ) ;

// リクエストを実行
       $curl = curl_init() ;
       curl_setopt( $curl, CURLOPT_URL, "https://vision.googleapis.com/v1/images:annotate?key=" . $api_key ) ;
       curl_setopt( $curl, CURLOPT_HEADER, true ) ;
       curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "POST" ) ;
       curl_setopt( $curl, CURLOPT_HTTPHEADER, array( "Content-Type: application/json" ) ) ;
       curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false ) ;
       curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true ) ;
       if( isset($referer) && !empty($referer) ) curl_setopt( $curl, CURLOPT_REFERER, $referer ) ;
       curl_setopt( $curl, CURLOPT_TIMEOUT, 15 ) ;
       curl_setopt( $curl, CURLOPT_POSTFIELDS, $json ) ;
       $res1 = curl_exec( $curl ) ;
       $res2 = curl_getinfo( $curl ) ;
       curl_close( $curl ) ;

// 取得したデータ
       $json = substr( $res1, $res2["header_size"] ) ;
       $array_json=json_decode($json, true);

       $text=$array_json["responses"]["0"]["textAnnotations"]["0"]["description"];
        return $text;
       //echo $text;

   }

}
