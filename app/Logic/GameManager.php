<?php


namespace App\Logic;

use App\User;
use Illuminate\Support\Str;
use Pusher\Pusher;



class GameManager
{


    public static function checkUserExist($userId,$column="id"){
        $m=new User();
        return ($m->where($column,$userId)->count() == 0)?false:true;

    }




    public static function getUserData($userId,$column="id"){
        $m=new User();
        $q=$m->where($column,$userId);
        return ($q->count() == 0)?[]:$q->first()->toArray();

    }

    private function pusher(){
        //  dd(env('PUSHER_APP_KEY'));
        // dd([env("PUSHER_APP_KEY"), env("PUSHER_APP_SECRET"), env("PUSHER_APP_ID"), array('cluster' => env("PUSHER_APP_CLUSTER"))]);


        if(!isset($this->pushserClass))$this->pushserClass=new Pusher(env("PUSHER_APP_KEY"), env("PUSHER_APP_SECRET"), env("PUSHER_APP_ID"), ['useTLS'=>false,'cluster' => env("PUSHER_APP_CLUSTER")],'127.0.0.1');

        return $this->pushserClass;
    }

    private function notifyForMatch($matchId=null,$type="",$data=[]){
        if($matchId==null) return false;

        event(new \App\Events\GameBrodcaster($matchId,$type,$data));
        return true;

    }


    public static function hostGame($userId):object {

      //  dd();
        if(!self::checkUserExist($userId))return response()->json(['error'=>'something wrong'],422);

        $match=[
            'match_id'=>strtoupper(Str::random(6)),
            'match_started'=>false,
            'user_host'=>$userId,
            'user_client'=>'',
            'created_at'=>now(),
            'updated_at'=>now()
        ];

        $m=new \App\Model\LiveGame();

        try {

            if($m->insert($match)){
                $returnData=[
                    'matchId'=>$match['match_id']
                ];
                return response()->json($returnData);
            }else{
                return response()->json(['error'=>'something wrong'],422);
            }

        }catch (\Exception $e){
            return response()->json(['error'=>'something wrong'],422);
        }


    }


    public static function joinGame($userId,$matchCode):object {
        if(!self::checkUserExist($userId))return response()->json(['error'=>'something wrong'],422);

       // $matchCode='AIJJWB';

        $m=new \App\Model\LiveGame();
        $q=$m->where('match_id',$matchCode)->where('match_started',false);
        if($q->count()){

            $foundMatch=$q->first()->toArray();
            $userData=
            $c=new self();
            $c->notifyForMatch($matchCode,'matchStarted',['data'=>['userClient'=>$userId,'userClientData'=>self::getUserData($userId)]]);


            if($userId!=$foundMatch['user_host']){
                $updateArray=[
                    'updated_at'=>now(),
                    'user_client'=>$userId,
                    'match_started'=>1
                ];

                try {


                    $q->update($updateArray);
                    return response()->json(['msg'=>'match joined']);

                }catch (\Exception $e){
                    dd($e);
                    return response()->json(['error'=>'no match found'],422);
                }


            }else{
                return response()->json(['error'=>'no match found'],422);
            }


        }else{
            return response()->json(['error'=>'no match found'],422);
        }





    }

    public static function startGame($userId,$matchCode):object{
        if(!self::checkUserExist($userId))return response()->json(['error'=>'something wrong'],422);

        $m=new \App\Model\LiveGame();
        $q=$m->where('match_id',$matchCode)->where('match_started',true);
        //dd($q->count());
        if($q->count()) {

            $c=new self();
            $c->notifyForMatch($matchCode,'matchStarted',['data'=>['userHost'=>$userId,'userHostData'=>self::getUserData($userId)]]);

         }

        return  response()->json( ['msg'=>'notifued']);


    }
    public static function moveGame($input,$userId,$matchCode){
        if(!self::checkUserExist($userId))return response()->json(['error'=>'something wrong'],422);
        $m=new \App\Model\LiveGame();
        $move=$input['move'];
        $q=$m->where('match_id',$matchCode)->where('match_started',true);
        //dd($q->count());
        if($q->count()) {
            $foundMatch=$q->first()->toArray();
            $c=new self();
            if($foundMatch['user_host']==$userId){
                $c->notifyForMatch($matchCode,'moveTaken',['data'=>['move'=>$move ,'userHost'=>$userId]]);
            }else{
                $c->notifyForMatch($matchCode,'moveTaken',['data'=>['move'=>$move ,'userClient'=>$userId]]);
            }


        }

        return  response()->json( ['msg'=>'notifued']);
    }

    public static function endGame($matchCode){
        $m=new \App\Model\LiveGame();
        $q=$m->where('match_id',$matchCode)->where('match_started',true);


        if($q->count()) {
            $m2=new \App\Model\FinishedGame();
            $foundMatch=$q->first()->toArray();
            //if(array_key_exists('created_at',$foundMatch))unset()
            $q->delete();
            $m2->insert($foundMatch);
            $c=new self();
            $c->notifyForMatch($matchCode,'endGame',['data'=>['matchData'=>$foundMatch]]);
            return  response()->json( ['msg'=>'match ended'],);
        }else{
            return  response()->json( ['error'=>'something wrong'],422);
        }
    }

    private function getNewMatchId():string {

    }

    public function checkMatchId($id):bool {

    }


}
