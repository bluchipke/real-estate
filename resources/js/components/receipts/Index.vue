<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <!-- <span class="input-group-addon"><i class="fa fa-filter"></i></span> -->
                                    <input type="text" class="form-control">
                                    <!-- <span class="input-group-addon">Search</span> -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-1">
                                        <button type="submit" class="btn btn-primary btn-sm btn-flat" title="Approve"> <i class="fa fa-check"></i></button>
                                    </div>
                                     <div class="col-md-1">
                                        <button type="submit" class="btn btn-success btn-sm btn-flat" title="Confirm"> <i class="fa fa-link"></i></button>
                                    </div>
                                     <div class="col-md-1">
                                        <button type="submit" class="btn btn-warning btn-sm btn-flat" title="Email Invoices"> <i class="fa fa-envelope"></i></button>
                                    </div>
                                     <div class="col-md-1">
                                        <button type="submit" class="btn btn-info btn-sm btn-flat" title="Send SMS"> <i class="fa fa-mobile"></i></button>
                                    </div>
                                     <div class="col-md-1">
                                        <button type="submit" class="btn btn-danger btn-sm btn-flat" title="Reverse"> <i class="fa fa-close"></i></button>
                                    </div>
                                     <!-- <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary btn-sm btn-flat"> <i class="fa fa-check"></i> New</button>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">                             
                            <div class="col-md-10">
                                RECEIPTS
                            </div>
                            <div class="col-md-2">
                                <a href="#" class="btn btn-sm btn-success btn-flat" @click.prevent="showItem">NEW RECEIPT</a>
                            </div>                                                     
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped table-fixed">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tenant</th>
                                    <th>Property/Unit</th>
                                    <th>Paid By </th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Reference</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(d, index) in payments.data" :key="d.payment_id">
                                    <td>{{++index}}</td>
                                    <td> <a href="#" @click.prevent="updateItem(d)" >{{d.first_name+' '+d.last_name}}</a> </td>
                                    <td>{{d.property_name+', '+d.unit_number}}</td>
                                    <td>{{d.paid_by}}</td>
                                    <td>{{d.amount_paid}}</td>
                                    <td>{{d.payment_date}}</td>
                                    <td>{{d.slip_no}}</td>
                                    <td></td>
                                   
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <!-- <pagination :data="payments" @pagination-change-page="getResults"></pagination> -->
                    </div>                   
                </div>
            </div>
            
        </div>    
        <!-- modal window for updating content --> 
           <div class="modal fade show" id="modal-receive" style="display: none;" aria-modal="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <p class="modal-title" v-if="this.edit_mode == false">NEW RECEIPT</p>
                            <p class="modal-title" v-if="this.edit_mode == true">UPDATE RECEIPT</p>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form @submit.prevent="this.edit_mode ? updatePayment() : createPayment()" @keydown="form.onKeydown($event)" class="form-horizontal"> 
                            <div class="modal-body">
            
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>New Receipt.</p>
                                        <hr>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-4" >Tenant / House:</label>
                                    <div class="col-md-8">
                                        <v-select v-model="form.tenant_id" :value="form.tenant_id" :options="accounts.data" label="tenant_name" name="tenant_id" :class="{ 'is-invalid': form.errors.has('tenant_id') }">
                                           
                                        </v-select>
                                            <has-error :form="form" field="tenant_id"></has-error>
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-4">Amount Paid</label>
                                    <div class="col-md-8">
                                        <input type="text" v-model="form.amount_paid" name="amount_paid" class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('amount_paid') }">
                                            <has-error :form="form" field="amount_paid"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-4">Paid By</label>
                                    <div class="col-md-8">
                                        <input type="text" v-model="form.paid_by" name="paid_by" class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('paid_by') }">
                                            <has-error :form="form" field="paid_by"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-4">Payment Slip No.</label>
                                    <div class="col-md-8">
                                        <input type="text" v-model="form.slip_no" name="slip_no" class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('slip_no') }">
                                            <has-error :form="form" field="slip_no"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-4" >Payment Date:</label>
                                    <div class="col-md-8">
                                        <vue-date-picker v-model="form.payment_date" :only-date="true" formatted="ll" name="payment_date" class="" format="YYYY-MM-DD" input-size="sm" :class="{ 'is-invalid': form.errors.has('payment_date') }"></vue-date-picker>
                                            <has-error :form="form" field="payment_date"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-4">Payment Method</label>
                                    <div class="col-md-8">
                                        <input type="text" v-model="form.payment_method" name="payment_method" class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('payment_method') }"/>
                                            
                                            <has-error :form="form" field="payment_method"></has-error>
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
            payments: {},
            utilities: {},
            edit_mode: false,    
            tenant_name: '', 
            accounts: {},   
            // driver_id: this.$route.params.id,
            vsearch: '',
            selected: '',
            properties: {},
            units: {},
            form: new Form({
                payment_id: '',
                amount_paid: '',
                paid_by: '',
                slip_no: '',
                invoice_id: '',
                property_id: '',
                payment_method:'',
                unit_id: '',
                tenant_id: '',
                item_name: [],
                item_amount: [],
                payment_date: '',
                invoice_no: '',
                invoice_status: '',
                payment_notes: '',
            })
        }
    },
    methods: {
        getAccount() {
			axios.get('api/tenant_unit')
				.then(({data}) => (this.accounts = data));					
		},
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
        getPayments(){
            
            axios.get('api/payments').then(({ data})=>(this.payments = data));
        },
        
        showItem(){
            this.edit_mode = false;
            this.form.reset();
            this.getAccount();
            $('#modal-receive').modal('show');
        },
        
        updateItem(d){
            this.edit_mode = true;
            this.form.reset();
            this.getAccount();
            $('#modal-receive').modal('show');            
            this.form.fill(d);
        },        
        
        createPayment(){
            this.$Progress.start();
            this.form.post('api/payments')
            .then(()=>{
                Toast.fire({
                    type: 'success',
                    title: 'Property type details saved successfully.'
                })
                $('#modal-receive').modal('hide');
                // this.getPropertyTypes();
            })
            .catch(()=>{
                Toast.fire({
                    type: 'warning',
                    title: 'Property type details failed to save'
                })
                this.$Progress.fail();
            });
            this.$Progress.finish();
        },
         
        updatePayment(){
            this.$Progress.start();
            this.form.put('api/payments/'+this.form.property_type_id)
            .then(()=>{
                Toast.fire({
                    type: 'success',
                    title: 'Property type details saved successfully.'
                })
                $('#modal-receive').modal('hide');
                // this.getPropertyTypes();
            })
            .catch(()=>{
                Toast.fire({
                    type: 'warning',
                    title: 'Property type details failed to save'
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
