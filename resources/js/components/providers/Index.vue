<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">                             
                            <div class="col-md-11">
                                SERVICE PROVIDER
                            </div>
                            <div class="col-md-1">
                                <a href="#" @click.prevent="showProvider"><i class="fa fa-plus"></i></a>
                            </div>                                                     
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped table-fixed">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Location</th>
                                    <th>Created</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(d, index) in providers.data" :key="d.provider_id">
                                    <td>{{++index}}</td>
                                    <td> <a href="#" @click.prevent="updateItem(d)" >{{d.provider_name}}</a> </td>
                                    <td>{{d.provider_email}}</td>
                                    <td>{{d.phone_no}}</td>
                                    <td>{{!null ? d.postal_code : ''}}, {{!null ? d.postal_address : ''}}</td>
                                    <td>{{!null ? d.business_location : ''}}</td>
                                    <td>{{d.created_at | moment('DD/MM/YYYY')}}</td>
                                    <td>{{d.status == 1 ? 'ACTIVE' : 'INACTIVE'}}</td>
                                   
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
        

          <!-- modal window for creating providers--> 
           <div class="modal fade show" id="modal-provider" style="display: none;" aria-modal="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-if="this.edit_mode == false">CREATE</h4>
                            <h4 class="modal-title" v-if="this.edit_mode == true">EDIT</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form @submit.prevent="edit_mode ? updateProvider() : createProvider()" @keydown="form.onKeydown($event)" class="form-horizontal"> 
                            <div class="modal-body">
            
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Provider Information</h5>
                                        <hr>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" >Name:</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="form.provider_name" name="provider_name" class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('provider_name') }">
                                            <has-error :form="form" field="provider_name"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" >Email:</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="form.provider_email" name="provider_email" class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('provider_email') }">
                                            <has-error :form="form" field="provider_email"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" >Phone:</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="form.phone_no" name="phone_no" class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('phone_no') }">
                                            <has-error :form="form" field="phone_no"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" >Location:</label>
                                    <div class="col-md-9">
                                        <textarea type="text" v-model="form.business_location" name="business_location" class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('business_location') }"></textarea>
                                            <has-error :form="form" field="business_location"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" >Address:</label>
                                    <div class="col-md-9">
                                        <textarea type="text" v-model="form.provider_address" name="provider_address" class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('provider_address') }"></textarea>
                                            <has-error :form="form" field="provider_address"></has-error>
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" style="text-transform: capitalize;">Notes:</label>
                                        <div class="col-md-9">
                                        <textarea type="text" v-model="form.provider_notes" name="provider_notes" id="provider_notes" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('provider_notes') }"></textarea>
                                            <has-error :form="form" field="provider_notes"></has-error>
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
            providers: {},
            edit_mode: false,        
            // driver_id: this.$route.params.id,
            vsearch: '',
            selected: '',
            form: new Form({
                provider_id: '',
                provider_address: '',
                provider_email: '',
                phone_no: '',
                provider_name: '',
                business_location: '',
                provider_notes: ''
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
        showItem(){
            this.edit_mode = false;
            this.form.reset();
            $('#modal-type').modal('show');
        },
        showProvider(){
            this.edit_mode = false;
            this.form.reset();
            $('#modal-provider').modal('show');
        },
        updateItem(d){
            this.edit_mode = true;
            this.form.reset();
            $('#modal-provider').modal('show');            
            this.form.fill(d);
        },
        updateModal(d){
            this.edit_mode = true;
            this.form.reset();
            $('#modal-provider').modal('show');            
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
                this.getPropertyTypes();
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
         createProvider(){
            this.$Progress.start();
            this.form.post('api/providers')
            .then(({data})=>{
                Toast.fire({
                    type: 'success',
                    title: data.message
                })
                $('#modal-provider').modal('hide');
                this.getProviders();
            })
            .catch(({data})=>{
                Toast.fire({
                    type: 'warning',
                    title: data.message
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
                this.getPropertyTypes();
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
        updateProvider(){
            this.$Progress.start();
            this.form.put('api/providers/'+this.form.utility_id)
            .then(({data})=>{
                Toast.fire({
                    type: 'success',
                    title: data.message
                })
                $('#modal-provider').modal('hide');
                this.getProviders();
            })
            .catch(({data})=>{
                Toast.fire({
                    type: 'warning',
                    title: data.message
                })
                this.$Progress.fail();
            });
            this.$Progress.finish();
        },
        
      
    },
    created(){
        this.$Progress.start();
        // this.getPropertyTypes();
        this.getProviders();
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
