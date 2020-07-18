<?php


namespace M\Coupon;

use Carbon\Carbon;
class Coupon
{


    public static function test(){


        dd(convert_uuencode('q'));

        return password_hash('1',PASSWORD_BCRYPT  );
        $c=new self();
        return $c->createCoupon(

            [
                'discount'=>5,
                'validUpTo'=>Carbon::now()->addYear()->gettimestamp(),
                'prefix'=>['test'],
                'validCount'=>0,
                'limit'=>[],
                'product'=>[],
                'user'=>[],
                'userType'=>[]
            ]
        );
    }

    private function createCoupon($data){
        if(array_key_exists('validUpTo',$data) ){
            $validUpto=Carbon::now()->gettimestamp();
        }

        $data=[
            'couponDiscount'=>(array_key_exists('discountType',$data))?$data['discountType']:'p',
            'discount'=>(array_key_exists('discount',$data))?$data['discount']:'0',
            'couponCode'=>  strtoupper(implode('-',array_merge(
                (array_key_exists('prefix',$data))?$data['prefix']:[]
                ,[$this->getNewCouponCode()]))),
            'validUpTo'=>(array_key_exists('validUpTo',$data))?$data['validUpTo']:Carbon::now()->addYear()->gettimestamp(),
            'limitCount'=>(array_key_exists('limit',$data))?$data['limit']:[],
            'validCount'=>0,
            'limitProduct'=>(array_key_exists('product',$data))?$data['product']:[],
            'limitUser'=>(array_key_exists('user',$data))?$data['user']:[],
            'limitUserType'=>(array_key_exists('userType',$data))?$data['userType']:[],
        ];



        return $data;
    }

    private function getNewCouponCode($count=6,$type=7,$lvl=1,$preFix=[],$dv='_'){

        $randstring=[];
        //  dd($preFix);
        switch ($type) {
            case'patern':
                $characters = '456';
                break;

            case '1':
                $characters = '123456789';
                break;

            case '2':
                $characters = 'abcdefghijklmnopqrstuvwxyz';
                break;

            case '3':
                $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;

            case '4':
                $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;


            case '5':
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;

            case '6':
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;

            case '7':
                $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;

            default:
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
        }

        if($lvl>1){
            $fCode=[];
            for ($i2 = 0; $i2 <= $lvl; $i2++){
                $randstring=[];
                for ($i = 0; $i < $count; $i++) {
                    $randstring[]= $characters[rand(0, strlen($characters)-1)];
                }

                $fCode[]=implode('',$randstring);


            }
            //dd($lvl);
            //dd([implode($dv,$fCode)]);
            $randstring=[implode($dv,$fCode)];
        }else{
            for ($i = 0; $i < $count; $i++) {
                $randstring[]=$characters[rand(0, strlen($characters)-1)];
            }
        }
        $randstring=implode('', $randstring);

        if(count($preFix)>0){
            //    dd($preFix);
            $preFix=implode($dv,$preFix);
            $randstring= implode($dv,[  $preFix,$randstring]);
        }

        return $randstring ;


    }

    private function checkValidCoupon($coupnCode){}

    private function editCoupon($couponId,$upData){}
    private function deleteCoupon($couponId){}
    private function  getCoupon($couponId){}

    private function  addUserToCoupon($couponId,$user){}
    private function  removeUserToCoupon($couponId,$user){}

    private function  addUserCategoryToCoupon($couponId,$userCat){}
    private function  removeUserCategoryToCoupon($couponId,$userCat){}

    private function  addProductToCoupon($couponId,$product){}
    private function  removeProductToCoupon($couponId,$product){}



}
