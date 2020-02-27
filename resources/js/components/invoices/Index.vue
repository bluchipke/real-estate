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
                            <div class="col-md-8">
                                INVOICES
                            </div>
                            <div class="col-md-2">
                                <router-link to="/invoices/tenant" class="btn btn-info btn-sm btn-flat" title="This option is used to generate invoices payable by your tenants for the various services offered in a given period.">INVOICE TENANT</router-link>
                            </div> 
                             <div class="col-md-2">
                                <router-link to="/invoices/landlord" class="btn btn-warning btn-sm btn-flat">INVOICE LANDLORD</router-link>
                            </div>                                                      
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped table-fixed">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Property/Unit</th>
                                    <th>Sent To </th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Items</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(d, index) in property_types.data" :key="d.property_type_id">
                                    <td>{{++index}}</td>
                                    <td> <a href="#" @click.prevent="updateItem(d)" >{{d.property_type_name}}</a> </td>
                                    <td>{{d.all_units}}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                   
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="property_types" @pagination-change-page="getResults"></pagination>
                    </div>                   
                </div>
            </div>
            
        </div>    
        <!-- modal window for updating content --> 
           <div class="modal fade show" id="modal-type" style="display: none;" aria-modal="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <p class="modal-title" v-if="this.edit_mode == false">NEW INVOICE</p>
                            <p class="modal-title" v-if="this.edit_mode == true">UPDATE INVOICE</p>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form @submit.prevent="this.edit_mode ? updatePropertyType() : createPropertyType()" @keydown="form.onKeydown($event)" class="form-horizontal"> 
                            <div class="modal-body">
            
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>Generate new tenant invoices</p>
                                        <hr>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" >Property:</label>
                                    <div class="col-md-9">
                                        <v-select v-model="form.property_id" :value="form.property_id" :options="properties.data" label="property_name" name="property_id" @input="getUnits(form.property_id.property_id)" :class="{ 'is-invalid': form.errors.has('property_id') }">
                                           
                                        </v-select>
                                            <has-error :form="form" field="property_id"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" >Unit:</label>
                                    <div class="col-md-9">
                                        <v-select v-model="form.unit_id" :options="units.data" :value="form.unit_id" label="unit_number" name="unit_id"  @input="getTenant(form.unit_id.unit_id)" :class="{ 'is-invalid': form.errors.has('unit_id') }">
                                            <!-- <option value="">Select Unit</option>
                                            <option v-for="u in units.data" :key="u.unit_id" :value="u.unit_id">{{u.unit_number}}</option> -->
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
                                    <label for="" class="form-label col-md-3" >Invoice Date:</label>
                                    <div class="col-md-9">
                                        <vue-date-picker v-model="form.invoice_date" :only-date="true" name="invoice_date" class="" format="YYYY-MM-DD" input-size="sm" :class="{ 'is-invalid': form.errors.has('invoice_date') }"></vue-date-picker>
                                            <has-error :form="form" field="invoice_date"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" >Items: ( <a href="#"><i class="fa fa-plus"></i></a> )</label>
                                    <div class="col-md-6">
                                        <input type="text" v-model="form.item_name" name="item_name" class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('item_name') }">
                                            <has-error :form="form" field="item_name"></has-error>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="item_amount" id="item_amount" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-1"><i class="fa fa-minus" style="color: red"></i></div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" style="text-transform: capitalize;">Notes:</label>
                                        <div class="col-md-9">
                                        <textarea rows="8" v-model="form.invoice_notes" name="invoice_notes" id="invoice_notes" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('invoice_notes') }"></textarea>
                                            <has-error :form="form" field="invoice_notes"></has-error>
                                    </div>
                                </div>

                                
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                <button :disabled="form.busy" @click.prevent="edit_mode ? updatePropertyType() : createPropertyType()" class="btn btn-sm btn-success"><i class="fa fa-check"></i> SUBMIT</button>
                                <a href="#" class="btn btn-sm btn-flat btn-warning" v-show="this.form.completed == 1">TRIP COMPLETED</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
         <!-- end of modal-->

          <!-- modal window for creating utilities --> 
           <div class="modal fade show" id="modal-utility" style="display: none;" aria-modal="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-if="this.edit_mode == false">CREATE</h4>
                            <h4 class="modal-title" v-if="this.edit_mode == true">EDIT</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form @submit.prevent="edit_mode ? updateUtility() : createUtility()" @keydown="form.onKeydown($event)" class="form-horizontal"> 
                            <div class="modal-body">
            
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Utility Information</h5>
                                        <hr>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" >Name:</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="form.utility_name" name="utility_name" class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('utility_name') }">
                                            <has-error :form="form" field="utility_name"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" style="text-transform: capitalize;">Billable:</label>
                                        <div class="col-md-9">
                                        <input type="checkbox" v-model="form.billable" name="billable" id="billable" true-value="1" false-value="0" :class="{ 'is-invalid': form.errors.has('billable') }" />
                                            <has-error :form="form" field="billable"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" style="text-transform: capitalize;">Notes:</label>
                                        <div class="col-md-9">
                                        <textarea type="text" v-model="form.utility_notes" name="utility_notes" id="utility_notes" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('utility_notes') }"></textarea>
                                            <has-error :form="form" field="utility_notes"></has-error>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" :disabled="form.busy" class="btn btn-sm btn-success"><i class="fa fa-check"></i> SUBMIT</button>
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
            utilities: {},
            edit_mode: false,    
            tenant_name: '',    
            // driver_id: this.$route.params.id,
            vsearch: '',
            selected: '',
            properties: {},
            units: {},
            form: new Form({
                invoice_id: '',
                property_id: '',
                unit_id: '',
                // tenant_name: [],
                item_name: [],
                item_amount: [],
                invoice_date: '',
                invoice_no: '',
                invoice_status: '',
                invoice_notes: '',
                billable: ''
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
        getUtilities(){
            
            axios.get('api/utilities').then(({ data})=>(this.utilities = data));
        },
        showItem(){
            this.edit_mode = false;
            this.form.reset();
            this.getProperties();
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
            $('#modal-type').modal('show');            
            this.form.fill(d);
        },
        updateModal(d){
            this.edit_mode = true;
            this.form.reset();
            $('#modal-utility').modal('show');            
            this.form.fill(d);
        },
        createPropertyType(){
            this.$Progress.start();
            this.form.post('api/property_types')
            .then(()=>{
                Toast.fire({
                    type: 'success',
                    title: 'Property type details saved successfully.'
                })
                $('#modal-type').modal('hide');
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
         createUtility(){
            this.$Progress.start();
            this.form.post('api/utilities')
            .then(()=>{
                Toast.fire({
                    type: 'success',
                    title: 'Utility details saved successfully.'
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
        updatePropertyType(){
            this.$Progress.start();
            this.form.put('api/property_types/'+this.form.property_type_id)
            .then(()=>{
                Toast.fire({
                    type: 'success',
                    title: 'Property type details saved successfully.'
                })
                $('#modal-type').modal('hide');
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
        this.getUtilities();
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
