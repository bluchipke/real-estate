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
                                <a href="#" @click.prevent="showItem" class="btn btn-info btn-sm btn-flat" title="This option is used to generate invoices payable by your tenants for the various services offered in a given period.">INVOICE TENANT</a>
                            </div> 
                             <div class="col-md-2">
                                <a href="#" @click.prevent="showItem" class="btn btn-warning btn-sm btn-flat">INVOICE LANDLORD</a>
                            </div>                                                      
                        </div>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="this.edit_mode ? updateInvoice() : createInvoice()" @keydown="form.onKeydown($event)" class="form-horizontal"> 
                            <!-- <div class="modal-body"> -->
            
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>This option is used to generate invoices payable by your tenants for the various services offered in a given period.</p>
                                        <hr>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" >Tenant Name / House:</label>
                                    <div class="col-md-9">
                                        <v-select v-model="form.tenant_id" :value="form.tenant_id" :options="tenants.data" label="tenant_name" name="tenant_id" @input="getUnits(form.property_id.property_id)" :class="{ 'is-invalid': form.errors.has('tenant_id') }">
                                           
                                        </v-select>
                                            <has-error :form="form" field="tenant_id"></has-error>
                                    </div>
                                </div>
                                <!-- <div class="form-group row">
                                    <label for="" class="form-label col-md-3" >Unit:</label>
                                    <div class="col-md-9">
                                        <v-select v-model="form.unit_id" :options="units.data" :value="form.unit_id" label="unit_number" name="unit_id"  @input="getTenant(form.unit_id.unit_id)" :class="{ 'is-invalid': form.errors.has('unit_id') }">
                                             <option value="">Select Unit</option>
                                            <option v-for="u in units.data" :key="u.unit_id" :value="u.unit_id">{{u.unit_number}}</option> 
                                         </v-select>
                                            <has-error :form="form" field="unit_id"></has-error>
                                    </div>
                                </div>  -->
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" >Invoice Date:</label>
                                    <div class="col-md-9">
                                        <vue-date-picker v-model="form.invoice_date" :only-date="false" name="invoice_date" class="" format="YYYY-MM-DD hh:mm A" input-size="sm" :class="{ 'is-invalid': form.errors.has('invoice_date') }"></vue-date-picker>
                                            <has-error :form="form" field="invoice_date"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3">Invoice #</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="form.invoice_no" name="invoice_no" class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('invoice_no') }">
                                            <has-error :form="form" field="invoice_no"></has-error>
                                    </div>
                                </div>
                                <!-- <div class="form-group row">
                                    <label for="" class="form-label col-md-3" >Items: ( <a href="#"><i class="fa fa-plus"></i></a> )</label>
                                    <div class="col-md-6">
                                        <input type="text" v-model="form.item_name" name="item_name" class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('item_name') }">
                                            <has-error :form="form" field="item_name"></has-error>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="item_amount" id="item_amount" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-1"><i class="fa fa-minus" style="color: red"></i></div>
                                </div> -->
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" style="text-transform: capitalize;">Comments:</label>
                                        <div class="col-md-9">
                                        <textarea rows="8" v-model="form.invoice_notes" name="invoice_notes" id="invoice_notes" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('invoice_notes') }"></textarea>
                                            <has-error :form="form" field="invoice_notes"></has-error>
                                    </div>
                                </div>

                                
                            <!-- </div> -->
                            <div class="modal-footer justify-content-between">
                                <button :disabled="form.busy" @click.prevent="generateInvoice" class="btn btn-sm btn-success"><i class="fa fa-check"></i> GENERATE</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <!-- <pagination :data="property_types" @pagination-change-page="getResults"></pagination> -->
                    </div>                   
                </div>
            </div>            
        </div>   
        
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
            // driver_id: this.$route.params.id,
            vsearch: '',
            selected: '',
            properties: {},
            tenants: {},
            units: {},
            form: new Form({
                invoice_no: '',
                invoice_id: '',
                property_id: '',
                tenant_id: '',
                invoice_date: '',
                invoice_status: '',
                invoice_notes: '',
                billable: ''
            })
        }
    },
    methods: {
        generateInvoice(){

            this.$Progress.start();            
                window.open('../uwezo/reports/tenants/'+this.form.tenant_id.tenant_id+'/invoice/','popUpWindow','height='+screen.height+',width='+screen.width+',left=100,top=100,resizable=no,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no, status=yes');            
            this.$Progress.finish();

        },        
        getTenant(id)
        {
            axios.get('api/current_tenant/'+id).then(({ data })=>(this.tenant_name = data.first_name+' '+data.last_name))
        },

        getTenantInfo(){
            axios.get('api/tenant_unit').then(({ data })=>(this.tenants = data))
        },

        getUtilities(){
            
            axios.get('api/utilities').then(({ data})=>(this.utilities = data));
        },
        showItem(){
            this.edit_mode = false;
            this.form.reset();
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
        createInvoice(){
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
        
        updateInvoice(){
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
        }  
        
      
    },
    created(){
        this.$Progress.start();        
        this.getTenantInfo();
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
