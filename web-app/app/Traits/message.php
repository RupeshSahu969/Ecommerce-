<?php
namespace App\Traits;

trait Message {

    public function success($msg='',$data=[], $http=200)
    {

        dd("Hello Trait");
        $body = [
            "status"=>$http,
            "msg"=>$msg,
            "data"=>$data
        ];
        return response()->json($body, $http);
    }

    public function error($msg='', $errors=[], $http=500)
    {
        // go through each messages
        if(count($errors) > 0){
            foreach ($errors as $key => $error) {
                $msg = $error[0];
                break;
            }
        }

        $body = [
            "status"=>$http,
            "msg"=>$msg,
            "data"=>[]
        ];
        return response()->json($body, $http);
    }
}



?>