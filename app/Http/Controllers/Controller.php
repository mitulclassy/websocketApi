<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function invoiceForm(){
        $deData=[];
        return view ('invoiceForm')->with('data',$deData);;

    }

    public function  invoiceFormPost(Request $r){
            
            $input=$r->all();
           
            $dataRaw=[
                'InvoiceNo'=>$input['invoiceNo'],
                'InvoiceDate'=>$input['invoiceDate'],
                'Receivername'=>$input['recevierName'],
                'InvoiceTotal'=>$input['invoiceTotal'],
                'invoiceDetails'=>collect($input['itemData'])->toJson(),
                'created_at'=>now(),
                'updated_at'=>now()

            ];
          //  dd($dataRaw);
            
            \DB::table('invocie')->insert($dataRaw);

    }

    public function invoiceFormDelete(Request $r,$id){
      return   \DB::table('invocie')->where('id', '=', $id)->delete();
    }

    public function invoiceFormList(){
        return view ('invoiceList');

    }

    public function invoiceListData(Request $r){
        return  \DB::table('invocie')->get();
    }

    public function invoiceFormEdit(Request $r,$id){
        
        $data=\DB::table('invocie')->where('id', '=', $id)->get();
        
        $db=$data->first();
        $deData['listData']=json_decode($db->invoiceDetails,true);



        $deData['mainData']=[       
        'invoiceDate'=>$db->InvoiceDate,
        'invoiceNo'=>$db->InvoiceNo,
        'invoiceTotal'=>$db->InvoiceTotal,
        'recevierName'=>$db->Receivername
        ];
        //dd($deData);

        $deData=collect($deData)->toJson();


        return view ('invoiceForm')->with('data',$deData);

    }
    public function index()
    {
        return view('home');
    }
    public function index_post(Request $request)
    {
        //dd($request);
         if($request->id)
        {

            DB::table('table1')
            ->update(["name"=>$request->name,"address"=>$request->address,"web"=>$request->web,"mail"=>$request->mail]);
        
         return redirect()->route('index');
        }
        else
        {
            DB::table('table1')
            ->insert(["name"=>$request->name,"address"=>$request->address,"web"=>$request->web,"mail"=>$request->mail]);
        
         return redirect()->route('index');
        }
    }
    public function view()
    {
        $data=DB::table('table1')->get();
        return view('view')->withdata($data);
    }
    public function delete($id)
    {
        $query = DB::table('table1')
                  ->where('id','=',$id)
                  ->delete();

        $data=DB::table('table1')->get();
        return view('view')->withdata($data);
    }
    public function edit($id)
    {
        $data=DB::table('table1')
          ->where('id','=',$id)
          ->get();
      return view('home1')->withdata($data); 
    }
}
