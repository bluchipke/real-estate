<template>
    <div class="container">          
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">                             
                            <div class="col-md-10">
                                PAYMENTS MADE
                            </div>
                            <div class="col-md-2">
                                <a href="#" @click.prevent="showItem" class="btn btn-primary btn-sm btn-flat">MAKE PAYMENT</a>
                            </div>                                                     
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped table-fixed">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Billing No.</th>
                                    <th>Amount</th>
                                    <th>Refernce</th>
                                    <th>Payment Mode</th>
                                    <th>Customer Details</th>
                                    <th>Paid By</th>
                                    <th>Trans Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(d, index) in payments.data" :key="d.payable_id">
                                    <td>{{++index}}</td>
                                    <td> <a href="#" @click.prevent="updateItem(d)" >{{d.bill_desc}}</a> </td>
                                    <td>{{d.amount_paid}}</td>
                                    <td>{{d.reference}}</td>
                                    <td>{{d.payment_mode}}</td>
                                    <td>{{d.provider_name}}</td>
                                    <td>{{d.paid_by}}</td>
                                    <td>{{d.trans_date}}</td>
                                   
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <!-- <pagination :data="property_types" @pagination-change-page=""></pagination> -->
                    </div>                   
                </div>
            </div>
            
        </div>    
               
        <!-- modal window for updating content --> 
           <div class="modal fade show" id="modal-payment" style="display: none;" aria-modal="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <p class="modal-title" v-if="this.edit_mode == false">NEW PAYMENT</p>
                            <p class="modal-title" v-if="this.edit_mode == true">UPDATE PAYMENT</p>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form @submit.prevent="this.edit_mode ? updatePayment() : createPayment()" @keydown="form.onKeydown($event)" class="form-horizontal"> 
                            <div class="modal-body">
            
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>MAKE PAYMENT.</p>
                                        <hr>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-4" >Bill ID:</label>
                                    <div class="col-md-8">
                                        <v-select v-model="form.bill_desc" :value="form.bill_id" :options="bills.data" label="bill_desc" name="bill_id" :class="{ 'is-invalid': form.errors.has('bill_id') }">
                                           
                                        </v-select>
                                            <has-error :form="form" field="bill_id"></has-error>
                                    </div>
                                </div>
                               
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-4">Amount Paid</label>
                                    <div class="col-md-8">
                                        <input type="number" v-model="form.amount_paid" name="amount_paid" class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('amount_paid') }">
                                            <has-error :form="form" field="amount_paid"></has-error>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-4">Payment Mode</label>
                                    <div class="col-md-8">
                                        <input type="text" v-model="form.payment_mode" name="payment_mode" class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('payment_mode') }">
                                            <has-error :form="form" field="payment_mode"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-4">Reference</label>
                                    <div class="col-md-8">
                                        <input type="text" v-model="form.reference" name="reference" class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('reference') }">
                                            <has-error :form="form" field="reference"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-4" >Transaction Date:</label>
                                    <div class="col-md-8">
                                        <vue-date-picker v-model="form.trans_date" :only-date="true" name="trans_date" class="" format="YYYY-MM-DD" input-size="sm" :class="{ 'is-invalid': form.errors.has('trans_date') }"></vue-date-picker>
                                            <has-error :form="form" field="trans_date"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-4">Provider Account</label>
                                    <div class="col-md-8">
                                        <v-select v-model="form.provider_name" :value="form.provider_id" :options="providers.data" label="provider_name" name="provider_id" :class="{ 'is-invalid': form.errors.has('provider_id') }">
                                           
                                        </v-select>
                                            <has-error :form="form" field="provider_id"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-4" style="text-transform: capitalize;">Notes:</label>
                                        <div class="col-md-8">
                                        <textarea rows="8" v-model="form.payment_notes" name="payment_notes" id="payment_notes" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('payment_notes') }"></textarea>
                                            <has-error :form="form" field="payment_notes"></has-error>
                                    </div>
                                </div>

                                
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                <button :disabled="form.busy" @click.prevent="edit_mode ? updatePayment() : createPayment()" class="btn btn-sm btn-success"><i class="fa fa-check"></i> SUBMIT</button>
                                <a href="#" class="btn btn-sm btn-flat btn-warning" v-show="this.form.completed == 1">TRIP COMPLETED</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
         <!-- end of modal-->
    </div>    
</template>
<script>
export default {
    components:{
        datetime,
    },
    data() {
        return {
            property_types: {},
            bills:{},
            utilities: {},
            providers: {},
            payments: {},
            edit_mode: false,    
            tenant_name: '',    
            // driver_id: this.$route.params.id,
            vsearch: '',
            selected: '',
            properties: {},
            units: {},
            form: new Form({
                bill_id: '',
                bill_desc:'',
                property_id: '',
                provider_name:'',
                payment_notes:'',
                unit_id: '',
                amount_paid: '',
                reference: '',
                trans_date: '',
                payment_mode: '',
                provider_id:'',
                paid_by: '',
            })
        }
    },
    methods: {
        
        getProperties(){
            axios.get('api/properties').then(({ data})=>(this.properties = data));
        },
        getUnits(id)
        {
            axios.get('api/property_units/'+id).then(({data})=>(this.units = data));
        },
        getTenant(id)
        {
            axios.get('api/current_tenant/'+id).then(({ data })=>(this.tenant_name = data.first_name+' '+data.last_name))
        },
        getBills(){
            
            axios.get('api/bills').then(({ data})=>(this.bills = data));
        },
        getProviders(){
            
            axios.get('api/providers').then(({ data})=>(this.providers = data));
        },
        getPayments(){
            
            axios.get('api/payables').then(({ data})=>(this.payments = data));
        },
        showItem(){
            this.edit_mode = false;
            this.form.reset();
            this.getBills();
            this.getProviders();
            $('#modal-payment').modal('show');
        },        
       
        updateItem(d){
            this.edit_mode = true;
            this.form.reset();
            this.getProperties();
            $('#modal-payment').modal('show');            
            this.form.fill(d);
        },       
        
        createPayment(){
            this.$Progress.start();
            this.form.post('api/payables')
            .then(()=>{
                Toast.fire({
                    type: 'success',
                    title: 'Details saved successfully.'
                })
                $('#modal-payment').modal('hide');
                // this.getPropertyTypes();
            })
            .catch(()=>{
                Toast.fire({
                    type: 'warning',
                    title: 'Details failed to save'
                })
                this.$Progress.fail();
            });
            this.$Progress.finish();
        },
        
        updatePayment(){
            this.$Progress.start();
            this.form.put('api/payables/'+this.form.property_type_id)
            .then(()=>{
                Toast.fire({
                    type: 'success',
                    title: 'Details saved successfully.'
                })
                $('#modal-payment').modal('hide');
                // this.getPropertyTypes();
            })
            .catch(()=>{
                Toast.fire({
                    type: 'warning',
                    title: 'Details failed to save'
                })
                this.$Progress.fail();
            });
            this.$Progress.finish();
        },     
        
      
    },
    created(){
        this.$Progress.start();
        this.getPayments();
        this.$Progress.finish();

    }
}
</script>
<style scoped>
thead{
    color: #fff;
    background-color: #2a8ee0;
    font-size: 14px;
    padding: 0px;
    border: 1px solid #2a8ee0;
}

.table th, .table td {
    padding: 0.4rem 1.3rem;
}

.table td {
    font-size: 12px;
}

.table-fixed{
  width: 100%;
  background-color: #f3f3f3;
}
</style>
