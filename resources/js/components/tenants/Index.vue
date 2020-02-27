<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-5">
                                ALL TENANTS
                            </div>                            
                            <!-- <div class="col-md-2"></div> -->
                            <div class="col-md-5">
                                <!-- SEARCH FORM -->
                                <div class="form-inline ml-3">
                                <div class="input-group input-group-sm">
                                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                    <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <router-link to="/tenants/create" class="btn btn-sm btn-primary btn-flat">NEW TENANT</router-link>
                            </div>
                                                    
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-fixed">
                            <thead>
                                <tr>
                                    <th>Index</th>
                                    <th>Name.</th>
                                    <th>Phone #</th>
                                    <th>Type</th>
                                    <th>Building</th>
                                    <th>House </th>
                                    <!-- <th>Billing</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, index) in tenants.data" :key="v.tenant_id">
                                    <td>{{++index}}</td>
                                    <td><router-link :to="'/tenants/'+v.tenant_id+'/show'">{{v.tenant_name}}</router-link></td>
                                    <td>{{v.phone_number}}</td>
                                    <td>{{v.tenant_type_name}}</td>
                                    <td>{{v.unit_number+', '+v.property_name}}</td>
                                    <td>
                                        <a href="#" @click.prevent="modalAllocate(v.tenant_id, v)" v-if="v.allocated == 0"><i class="fa fa-check" title="Assign Unit"></i></a>
                                        <a href="#" @click.prevent="modalAllocate(v.tenant_id, v)" v-if="v.allocated == 1"><i class="fa fa-sticky-note" title="History"></i></a>
                                    </td>
                                    <!-- <td>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <router-link to="#"><i class="fa fa-note">N</i></router-link>
                                            </div>
                                            <div class="col-md-3">
                                                <router-link to="#"><i class="fa fa-note">A</i></router-link>
                                            </div>
                                            <div class="col-md-3">
                                                <router-link to="#"><i class="fa fa-note">D</i></router-link>
                                            </div>                                            
                                        </div>
                                    </td> -->
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="tenants" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        STATS
                    </div>
                    <div class="card-body">
                        These are statistics
                    </div>
                </div>
            </div> -->
        </div> 
         <!-- modal window for creating utilities --> 
        <div class="modal fade show" id="modal-allocate" style="display: none;" aria-modal="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" >Tenant: {{tenant.first_name+' '+tenant.last_name}}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form @submit.prevent="allocateTenant" @keydown="form.onKeydown($event)" class="form-horizontal"> 
                            <div class="modal-body">            
                                
                                <!-- <div class="form-group row">
                                    <label for="" class="form-label col-md-3" >Name:</label>
                                    <div class="col-md-9">
                                        <input type="text" disabled v-model="form.first_name" name="first_name" class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('first_name') }">
                                            <has-error :form="form" field="first_name"></has-error>
                                    </div>
                                </div> -->
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" style="text-transform: capitalize;">Property:</label>
                                        <div class="col-md-9">
                                        <select v-model="form.property_id" name="property_id" id="property_id" @change="getPropertyUnits(form.property_id)" class="form-control" :class="{ 'is-invalid': form.errors.has('property_id') }">
                                            <option value="" selected>Select</option>
                                            <option v-for="pro in properties.data" :key="pro.property_id" :value="pro.property_id">{{pro.property_name}}</option>
                                        </select>
                                            <has-error :form="form" field="property_id"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" style="text-transform: capitalize;">Unit / Room:</label>
                                        <div class="col-md-9">
                                        <select v-model="form.unit_id" name="unit_id" id="unit_id" class="form-control"  :class="{ 'is-invalid': form.errors.has('unit_id') }">
                                            <option value="">Select</option>
                                            <option v-for="unit in units" :key="unit.unit_id" :value="unit.unit_id">{{unit.unit_number}}</option>
                                        </select>
                                            <has-error :form="form" field="unit_id"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" style="text-transform: capitalize;">Agreement Date:</label>
                                        <div class="col-md-9">
                                        <!-- <input type="text" v-model="form.occupation_date" name="occupation_date" id="occupation_date" class="form-control form-control-sm"  :class="{ 'is-invalid': form.errors.has('occupation_date') }"> -->
                                        <vue-date-picker format="YYYY-MM-DD" formatted="ll" label="Select Date" :only-date="true" v-model="form.occupation_date" name="occupation_date"  :class="{ 'is-invalid': form.errors.has('occupation_date') }"></vue-date-picker>
                                                                                   
                                            <has-error :form="form" field="occupation_date"></has-error>
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" style="text-transform: capitalize;">Deposit Amount:</label>
                                        <div class="col-md-9">
                                        <input type="number" v-model="form.deposit_amount" name="deposit_amount" id="deposit_amount" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('deposit_amount') }">
                                            
                                            <has-error :form="form" field="deposit_amount"></has-error>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" style="text-transform: capitalize;">Notes:</label>
                                        <div class="col-md-9">
                                        <textarea type="text" v-model="form.occupation_notes" name="occupation_notes" id="occupation_notes" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('occupation_notes') }"></textarea>
                                            <has-error :form="form" field="occupation_notes"></has-error>
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
    components: {
        datetime
    },
    data() {
        return {
            tenants: {},
            properties: {},
            units: {},
            tenant: '',
            vsearch: '',
            form: new Form({
                tenant_id: '',
                property_id: '',
                unit_id: '',
                occupation_date: '',                
                deposit_amount: '',
                occuptation_notes: ''
            }),

        }
    },
    methods: {
        getResults(page = 1) 
        {
			axios.get('api/tenants?page=' + page)
				.then(response => {
					this.tenants = response.data;
				});
		},
        getTenants()
        {

            axios.get('api/tenants').then(({ data})=>(this.tenants = data));
        },

        getProperties()
        {

            axios.get('api/properties').then(({ data})=>(this.properties = data));
        },
        // modal allocate box
        modalAllocate(id, d)
        {
            axios.get('api/tenants/'+id).then(({ data})=>(this.tenant = data ));
            this.getProperties();
            $('#modal-allocate').modal('show');            
            this.form.fill(d);
        },
        getPropertyUnits($id)
        {

            axios.get('api/vacant_units/'+$id).then(({data})=>(this.units = data));
        },
        allocateTenant($id)
        {
            this.form.post('api/allocate_unit')
            .then(()=>{
                this.form.reset();
                Toast.fire({
                    type: 'success',
                    title: 'Tenant allocation successful.'
                });
                this.getTenants();
            })
            .catch(()=>{

            })
            // this.form.reset();
        }
        
    },
    created(){
        this.$Progress.start();
        this.getTenants();
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


