  
<template>
<div class="container-fluid">
<table class="table table-striped table-bordered col-12">

            <thead class="thead-dark">
                <tr>
                    <th>Invoice No.</th>
                    <th>Invoice Date </th>
                    <th>Recevier Name </th>
                    <th>Invoice Total</th>
                    <th>edit</th>
                    <th>delete </th>
                </tr>



            </thead>




            <tr v-for="row in listData"> 
                    <td>{{      row.InvoiceNo }}</td>
                      <td>{{      row.InvoiceDate }}</td>
                        <td>{{      row.Receivername }}</td>
                          <td>{{      row.InvoiceTotal }}</td>
                          <td><div class="btn btn-info"  v-on:click="editInvoice(row)">edit</div></td>
                          <td><div class="btn btn-info" v-on:click="deleteInvocie(row)"> delete</div></td>

            </tr>



</table>

</div>


</template>

<script>
    export default {
        name: "invoicelist",
        props:{
            'msData':{
                type: String,
                required: false
            }
        },
        data(){

                return {
                    'listData':[],
                }
        },

        mounted(){
               this.refreshData()


        },
        methods:{
            refreshData(){
                var th= this ;
                var url='http://mitul.domain/invoiceList/data';
                axios.get(url).then(function(res){
                   
                    th.listData=res.data;
                }).catch((e)=>alert('error'));
            },
            deleteInvocie(row){
                 var th= this ;
                var url='http://mitul.domain/invoice/delete/'+row.id
                axios.get(url).then(function(res){
                   

                   
                }).then(()=>th.refreshData()).catch ((e)=>alert('error 2'))
            },
            editInvoice(row){
              
                var url='http://mitul.domain/invoice/edit/'+row.id
                   window.location.replace(url);
                
            }
        }

    }
</script>