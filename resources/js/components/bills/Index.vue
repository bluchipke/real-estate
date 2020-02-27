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
                                BILLS
                            </div>
                            <div class="col-md-2">
                                <a href="#" class="btn btn-primary btn-flat btn-sm" @click.prevent="showItem">ADD NEW BILL</a>
                            </div>                                                     
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped table-fixed">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Bill To</th>
                                    <th>Bill From </th>
                                    <th>Desc</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(d, index) in bills.data" :key="d.bill_id">
                                    <td>{{++index}}</td>
                                    <td> <a href="#" @click.prevent="updateItem(d)" >{{d.property_name}} {{d.unit_number}}</a> </td>
                                    <td>{{d.provider_name}}</td>
                                    <td>{{d.bill_desc}}</td>
                                    <td>{{d.bill_amount}}</td>
                                    <td>{{d.bill_date}}</td>
                                    <td>{{d.paid ==0 ? 'UNPAID' : 'PAID'}}</td>
                                    <td></td>
                                   
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <!-- <pagination :data="property_types" @pagination-change-page="getResults"></pagination> -->
                    </div>                   
                </div>
            </div>
            
        </div>    
        <!-- modal window for updating content --> 
           <div class="modal fade show" id="modal-type" style="display: none;" aria-modal="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <p class="modal-title" v-if="this.edit_mode == false">NEW BILL</p>
                            <p class="modal-title" v-if="this.edit_mode == true">UPDATE BILL</p>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form @submit.prevent="this.edit_mode ? updateBill() : createBill()" @keydown="form.onKeydown($event)" class="form-horizontal"> 
                            <div class="modal-body">
            
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>Create New Bill</p>
                                        <hr>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" >Property:</label>
                                    <div class="col-md-9">
                                        <v-select v-model="form.property_name" :value="form.property_id" :options="properties.data" label="property_name" name="property_id" @input="getUnits(form.property_name.property_id)" :class="{ 'is-invalid': form.errors.has('property_id') }">
                                           
                                        </v-select>
                                            <has-error :form="form" field="property_id"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" >Unit:</label>
                                    <div class="col-md-9">
                                        <v-select v-model="form.unit_number" :options="units.data" :value="form.unit_id" label="unit_number" name="unit_id"  @input="getTenant(form.unit_number.unit_id)" :class="{ 'is-invalid': form.errors.has('unit_id') }">
                                           
                                        </v-select>
                                            <has-error :form="form" field="unit_id"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3">Tenant</label>
                                    <div class="col-md-9">
                                        <input type="text" disabled v-model="this.tenant_name" name="tenant_name" class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('tenant_name') }">
                                            <has-error :form="form" field="tenant_name"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" >Provider:</label>
                                    <div class="col-md-9">
                                        <v-select v-model="form.provider_name" :options="providers.data" :value="form.provider_id" label="provider_name" name="provider_id"  :class="{ 'is-invalid': form.errors.has('provider_id') }">
                                           
                                        </v-select>
                                            <has-error :form="form" field="provider_id"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3">Description</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="form.bill_desc" name="bill_desc" class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('bill_desc') }">
                                            <has-error :form="form" field="bill_desc"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3">Bill Amount</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="form.bill_amount" name="bill_amount" min="0" class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('bill_amount') }">
                                            <has-error :form="form" field="bill_amount"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" >Bill Date:</label>
                                    <div class="col-md-9">
                                        <vue-date-picker v-model="form.bill_date" :only-date="true" name="bill_date" class="" format="YYYY-MM-DD" input-size="sm" :class="{ 'is-invalid': form.errors.has('bill_date') }"></vue-date-picker>
                                            <has-error :form="form" field="bill_date"></has-error>
                                    </div>
                                </div>        
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" style="text-transform: capitalize;">Include on Rent:</label>
                                        <div class="col-md-9">
                                        <input type="checkbox" v-model="form.include_rent" name="include_rent" id="include_rent" true-value="1" false-value="0" :class="{ 'is-invalid': form.errors.has('include_rent') }" />
                                            <has-error :form="form" field="include_rent"></has-error>
                                    </div>
                                </div>                        
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" style="text-transform: capitalize;">Notes:</label>
                                        <div class="col-md-9">
                                        <textarea rows="8" v-model="form.bill_notes" name="bill_notes" id="bill_notes" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('bill_notes') }"></textarea>
                                            <has-error :form="form" field="bill_notes"></has-error>
                                    </div>
                                </div>

                                
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                <button :disabled="form.busy" @click.prevent="edit_mode ? updateBill() : createBill()" class="btn btn-sm btn-success"><i class="fa fa-check"></i> SUBMIT</button>
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
            bills: {},
            utilities: {},
            providers: {},
            edit_mode: false,    
            tenant_name: '',    
            // driver_id: this.$route.params.id,
            vsearch: '',
            selected: '',
            properties: {},
            units: {},
            form: new Form({
                provider_id: '',
                provider_name:'',
                invoice_id: '',
                property_id: '',
                property_name: '',
                unit_number: '',
                unit_id: '',
                bill_desc: '',
                bill_date: '',
                bill_amount:'',
                invoice_no: '',
                invoice_status: '',
                bill_notes: '',
                include_rent: ''
            })
        }
    },
    methods: {
        getResults(page = 1) {
			axios.get('api/property_types?page=' + page)
				.then(response => {
					this.property_types = response.data;
				});
		},
        getProviders(){
            axios.get('api/providers').then(({ data})=>(this.providers = data));
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
        getBills(){
            
            axios.get('api/bills').then(({ data})=>(this.bills = data));
        },
        showItem(){
            this.edit_mode = false;
            this.form.reset();
            this.getProperties();
            this.getProviders();
            $('#modal-type').modal('show');
        },
        showUtility(){
            this.edit_mode = false;
            this.form.reset();
            $('#modal-utility').modal('show');
        },
        updateItem(d){
            this.edit_mode = true;
            this.form.reset();
            this.getProperties();
            this.getProviders();
            $('#modal-type').modal('show');            
            this.form.fill(d);
        },
        updateModal(d){
            this.edit_mode = true;
            this.form.reset();
            $('#modal-utility').modal('show');            
            this.form.fill(d);
        },
        createBill(){
            this.$Progress.start();
            this.form.post('api/bills')
            .then(()=>{
                Toast.fire({
                    type: 'success',
                    title: 'Bill details saved successfully.'
                })
                $('#modal-type').modal('hide');
                // this.getPropertyTypes();
            })
            .catch(()=>{
                Toast.fire({
                    type: 'warning',
                    title: 'Bill details failed to save'
                })
                this.$Progress.fail();
            });
            this.$Progress.finish();
        },
         createUtility(){
            this.$Progress.start();
            this.form.post('api/utilities')
            .then(()=>{
                Toast.fire({
                    type: 'success',
                    title: 'Utility details saved successfully.'
                })
                $('#modal-utility').modal('hide');
                this.getBills();
            })
            .catch(()=>{
                Toast.fire({
                    type: 'warning',
                    title: 'Utility details failed to save'
                })
                this.$Progress.fail();
            });
            this.$Progress.finish();
        },
        updateBill(){
            this.$Progress.start();
            this.form.put('api/bills/'+this.form.property_type_id)
            .then(()=>{
                Toast.fire({
                    type: 'success',
                    title: 'Bill details updated successfully.'
                })
                $('#modal-type').modal('hide');
                this.getBills();
            })
            .catch(()=>{
                Toast.fire({
                    type: 'warning',
                    title: 'Bill details failed to update'
                })
                this.$Progress.fail();
            });
            this.$Progress.finish();
        },
        updateUtility(){
            this.$Progress.start();
            this.form.put('api/utilities/'+this.form.utility_id)
            .then(()=>{
                Toast.fire({
                    type: 'success',
                    title: 'Utility details updated successfully.'
                })
                $('#modal-utility').modal('hide');
                this.getUtilities();
            })
            .catch(()=>{
                Toast.fire({
                    type: 'warning',
                    title: 'Utility details failed to save'
                })
                this.$Progress.fail();
            });
            this.$Progress.finish();
        },
        
      
    },
    created(){
        this.$Progress.start();
        // this.getPropertyTypes();
        this.getBills();
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
