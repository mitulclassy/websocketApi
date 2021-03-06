<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ChessController extends Controller
{
    public function userPage($userId){
        //dd($userId);
        $model=new User();
        $q=$model->where('id',$userId);
        if($q->count() ==1){
            $data=[
                'user'=>$q->first()->toArray(),
                'allUser'=>$model->whereNotIn ('id',[$userId])->pluck('name','id')->toArray(),


            ];
            $data['paths']=[
                'hostGame'=>action('ChessController@hostGame',['userId'=>$data['user']['id']]),
                'joinGame'=>action('ChessController@joinGame',['userId'=>$data['user']['id'],'matchId'=>'ChangeMatchId']),
                'moveGame'=>action('ChessController@moveGame',['userId'=>$data['user']['id'],'matchId'=>'ChangeMatchId']),
                'startNotifyForOther'=>action('ChessController@startGame',['userId'=>$data['user']['id'],'matchId'=>'ChangeMatchId']),
                'endGame'=>action('ChessController@endGame',['matchId'=>'ChangeMatchId']),

            ];
       // dd($data);
        return view('chess.userPage')->with('data',$data);

        }else{
            return response()->json(['error'=>['No User Found']],422);
        }
        dd($model->where('id',$userId)->count());

    }

    public function hostGame($userId){

        return \App\Logic\GameManager::hostGame($userId);
    }
    public function startGame($userId,$matchId){

        return \App\Logic\GameManager::startGame($userId,$matchId);
    }

    public function joinGame($userId,$matchId){
        return \App\Logic\GameManager::joinGame($userId,$matchId);
    }
    public function moveGame(Request $r,$userId,$matchId){
        return \App\Logic\GameManager::moveGame($r->all(),$userId,$matchId);
    }
    public function endGame($matchId){
            return \App\Logic\GameManager::endGame($matchId);
        }

    public function __call($method, $parameters)
    {
        parent::__call($method, $parameters); // TODO: Change the autogenerated stub


    }
}
