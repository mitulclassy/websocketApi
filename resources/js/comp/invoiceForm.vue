  
<template>
<div>

<div class="container-fluid">


    <div class="head-box">
 <center>
     <h2>Create Invoice</h2>
     </center>
    </div>
    <div class="row">
      
        <div class="col-6 customer-box">

            <div class="form-group " >
                 
                        <input v-model="formData.recevierName" class="form-control" type="text" placeholder="Enter Recevier Name"  >

                  </div>

                    <div class="form-group " >
                 
                    

                        <textarea  class="form-control" type="text" placeholder="Enter Recevier Billing Address"  > </textarea>
                    </div>
            </div>
        <div class="col-6 invoice-data-box">
            
            
               <div class="form-group " >
                 
                        <input v-model="formData.invoiceNo" class="form-control" type="text" placeholder="Enter Invoice No."  >

                  </div>

                    <div class="form-group " >
                 
                    

                        <input v-model="formData.invoiceDate" class="form-control" type="date" placeholder="Enter Invoice Date"   > </div>
             </div>

    </div>


    <div class="col-12">
        <table class="table table-striped table-bordered col-12">
            <thead class="thead-dark">
            <tr>
                <th>Sr. No.</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actula Amt.</th>
                <th colspan="2">Tax1(%)</th>
                <th colspan="2">Tax2(%)</th>
                <th colspan="2">Tax3(%)</th>
                <th>Total</th>
                
            </tr>
            </thead>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

                <td>Rate</td>
                <td>Amt.</td>

                <td>Rate</td>
                <td>Amt.</td>

                <td>Rate</td>
                <td>Amt.</td>

                <td></td>
                

                
                </tr>

            <tr v-for="(row,key) in allInput">

        
                <td>{{ key+1 }}</td>

                <td v-for="inp in row">

                    <div class="form-group " >
                 
                        <input v-model="input[key][inp.model]" class="form-control" :type="inp.type":placeholder="'Enter '+inp.name" :disabled="inp.disable==true" v-on:keyup="updateAllInput()">
                    </div>
                </td>

            </tr>

            <tr >
               

                 <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>

                <td></td>
                <td></td>

                <td></td>
                <td></td>

                <td>
                     <div class="btn btn-success" v-on:click="addInputRow()">+</div>
                </td>
            </tr>

            <tr>
                <td colspan="12">
                        <center>

                    <div class="btn- btn-info" v-on:click="postForm()">Save</div>
                        </center>
                </td>
            </tr>

        </table>
    </div>

    


</div>
</div>
</template>

<script>
    export default {
        name: "invoiceform",
        props:{
            'msData':{
              
                required: false
            }
        },
        data(){
            return {

                    input:{},
                    defaultRow: [
                        {
                            name:'Item Name',
                            type:'text',
                            model:'itemname',
                            disable:false
                        },
                        {
                            name:'Qt',
                            type:'number',
                            model:'qt',
                            disable:false,
                            default:0
                        },
                        {
                            name:'price',
                            type:'number',
                            model:'price',
                            disable:false,
                            default:0
                        },
                        {
                            name:'Actual Amt.',
                            type:'number',
                            model:'actualamt',
                            disable:true,
                            default:0
                        },
                        {
                            name:'Tax 1',
                            type:'number',
                            model:'tax1',
                            disable:false,
                            lable:'Rate',
                            default:0
                        },
                        {
                            name:'Tax 1',
                            type:'number',
                            model:'tax1amount',
                            disable:true,
                            lable:'Amt.',
                            default:0
                        },
                        {
                            name:'Tax 2',
                            type:'number',
                            model:'tax2',
                            disable:false,
                            lable:'Rate',
                            default:0
                        },
                        {
                            name:'Tax 2',
                            type:'number',
                            model:'tax2amount',
                            disable:true,
                            lable:'Amt.',
                            default:0
                        },
                        {
                            name:'Tax 3',
                            type:'number',
                            model:'tax3',
                            disable:false,
                            lable:'Rate',
                            default:0
                        },
                        {
                            name:'Tax 3',
                            type:'number',
                            model:'tax3amount',
                            disable:true,
                            lable:'Amt.',
                            default:0
                        },
                        {
                            name:'Total',
                            type:'number',
                            model:'total',
                            disable:true,
                            default:0
                        }
                    ],
                    
                    allInput:[
                    [
                        {
                            name:'Item Name',
                            type:'text',
                            model:'itemname',
                            disable:false
                        },
                        {
                            name:'Qt',
                            type:'number',
                            model:'qt',
                            disable:false,
                            default:0
                        },
                        {
                            name:'price',
                            type:'number',
                            model:'price',
                            disable:false,
                            default:0
                        },
                        {
                            name:'Actual Amt.',
                            type:'number',
                            model:'actualamt',
                            disable:true,
                            default:0
                        },
                        {
                            name:'Tax 1',
                            type:'number',
                            model:'tax1',
                            disable:false,
                            lable:'Rate',
                            default:0
                        },
                        {
                            name:'Tax 1',
                            type:'number',
                            model:'tax1amount',
                            disable:true,
                            lable:'Amt.',
                            default:0
                        },
                        {
                            name:'Tax 2',
                            type:'number',
                            model:'tax2',
                            disable:false,
                            lable:'Rate',
                            default:0
                        },
                        {
                            name:'Tax 2',
                            type:'number',
                            model:'tax2amount',
                            disable:true,
                            lable:'Amt.',
                            default:0
                        },
                        {
                            name:'Tax 3',
                            type:'number',
                            model:'tax3',
                            disable:false,
                            lable:'Rate',
                            default:0
                        },
                        {
                            name:'Tax 3',
                            type:'number',
                            model:'tax3amount',
                            disable:true,
                            lable:'Amt.',
                            default:0
                        },
                        {
                            name:'Total',
                            type:'number',
                            model:'total',
                            disable:true,
                            default:0
                        }
                    ]
                    

                    ],
                    formData:{
                        invoiceNo:"",
                        invoiceDate:"2020-07-09",
                        recevierName:"",
                        invoiceTotal:"",

                    }


            }
        },
        beforeMount(){

            if(this.msData.hasOwnProperty('mainData')){
                this.input=this.msData.listData;
                this.formData= this.msData.mainData;   
                for (var i in this.msData.listData){
                    this.allInput[i]=this.defaultRow;
                }


            }else{

                   for(var row in  this.allInput){
                    var rowInput={};

                    for(var  inp in  this.allInput[row]){

                        rowInput[this.allInput[row][inp].model]=(this.allInput[row][inp].hasOwnProperty('default'))? this.allInput[row][inp].default :"";
                        
                    }
                    this.input[row]=rowInput;
         
            }

            }
         
        }
,
        methods:{
                updateAllInput (newVal=null) {
                    var old =(newVal != null)? newVal:this.allInput;
                    this.allInput=[];
                    this.allInput=old;
                    this.processRow();
                },
                addInputRow(){
                    this.allInput.push(this.defaultRow);
                    var rowInput={};

                    for(var  inp in  this.defaultRow){

                        rowInput[this.defaultRow[inp].model]=(this.defaultRow[inp].hasOwnProperty('default'))? this.defaultRow[inp].default :"";
                        
                    }
                    this.input[this.allInput.length-1]=rowInput;
                    this.updateAllInput();
                },
                processRow(){
                        for(var i in this.input){

                            var oldVAl=this.input[i];
                           var newVAl=this.input[i];
                           if(oldVAl.qt!="" && oldVAl.price!=""){
                               newVAl.actualamt=oldVAl.qt*oldVAl.price;
                           }
                           if(newVAl.actualamt!="" && oldVAl.tax1!="" && oldVAl.tax1>0){
                               newVAl.tax1amount=newVAl.actualamt*(oldVAl.tax1/100);
                           }

                            if(newVAl.actualamt!="" && oldVAl.tax2!="" && oldVAl.tax2>0){
                               newVAl.tax2amount=newVAl.actualamt*(oldVAl.tax2/100);
                           }

                            if(newVAl.actualamt!="" && oldVAl.tax3!="" && oldVAl.tax3>0){
                               newVAl.tax3amount=newVAl.actualamt*(oldVAl.tax3/100);
                           }
                           newVAl.total=newVAl.actualamt+newVAl.tax1amount+ newVAl.tax2amount+ newVAl.tax3amount
                           this.input[i]=newVAl;

                        }
                },

                postForm(){
                        var totatlAll=0;
                for(var i in this.input){
                      totatlAll=  totatlAll+this.input[i].total

                }
                this.formData.invoiceTotal=totatlAll;

                if(this.formData.invoiceTotal >0 && this.formData.invoiceNo!="" &&this.formData.recevierName!="" ){
                    
                    this.formData.itemData=this.input;
                    axios({
                        method: 'post',
                        url: '/invoice/post',
                        data: this.formData
                        }).then(function(){
                                window.location.replace('http://mitul.domain/invoiceList');
                            
                        });
                }else{
                    alert('error');
                }

                }
        },
        watch:{
            input:function(newVal){

       
            }
            

        }


    }
</script>