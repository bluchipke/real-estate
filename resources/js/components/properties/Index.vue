<template>
    <div class="contai">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-5">
                                PROPERTIES
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-3">
                                <!-- SEARCH FORM -->
                                <div class="form-inline ml-3">
                                <div class="input-group input-group-sm">
                                    <input class="form-control form-control-navbar" type="search" v-model="vsearch" @keyup="searchV" placeholder="Search" aria-label="Search">
                                    <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    </div>
                                </div>
                                </div>
                            </div>                            
                            <div class="col-md-2">
                                <router-link to="/properties/create" class="btn btn-sm btn-primary">NEW PROPERTY</router-link>
                            </div>               
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped table-fixed">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name.</th>
                                    <th>Property Type</th>
                                    <th>Units</th>
                                    <th>Vacant</th>
                                    <th>Landlord</th>
                                    <th>Estate</th>
                                    <!-- <th>Mobile No.</th> -->
                                    <!-- <th>Date Started</th> -->
                                    <!-- <th>Employment Type</th> -->
                                    <!-- <th>Status</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(d, index) in properties.data" :key="d.property_id">
                                    <td>{{++index}}</td>
                                    <td><router-link :to="'/properties/'+d.property_id+'/show'">{{d.property_name}}</router-link></td>
                                    <td>{{d.property_type_name}}</td>
                                    <td>{{d.units_count}}</td>
                                    <td>{{d.no_floors}}</td>
                                    <td>{{d.first_name+' '+d.last_name}}</td>
                                    <td>{{d.location_name+', '+d.estate_name+', '+d.main_street}}</td>
                                    <!-- <td>{{d.phone_number}}</td> -->
                                    <!-- <td>{{d.date_started}}</td> -->
                                    <!-- <td>{{d.employment_type}}</td> -->
                                    <!-- <td>{{d.employment_status}}</td> -->
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="properties" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
            </div>
        </div> 
        <!-- modal dialog forms -->
        <!-- modal window for updating content --> 
           <div class="modal fade show" id="modal-type" style="display: none;" aria-modal="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-if="this.edit_mode == false">CREATE</h4>
                            <h4 class="modal-title" v-if="this.edit_mode == true">EDIT</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form @submit.prevent="this.edit_mode ? updateItem('estate') : createItem('estate')" @keydown="form.onKeydown($event)" class="form-horizontal"> 
                            <div class="modal-body">
            
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Information</h5>
                                        <hr>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" >Type Name:</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="form.property_type_name" name="property_type_name" class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('property_type_name') }">
                                            <has-error :form="form" field="property_type_name"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" style="text-transform: capitalize;">Notes:</label>
                                        <div class="col-md-9">
                                        <textarea type="text" v-model="form.type_notes" name="type_notes" id="type_notes" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('type_notes') }"></textarea>
                                            <has-error :form="form" field="type_notes"></has-error>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                <button :disabled="form.busy" @click.prevent="edit_mode ? updateItem('estate') : createItem('estate')" class="btn btn-sm btn-success"><i class="fa fa-check"></i> SUBMIT</button>
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
    data() {
        return {
            properties: {},
            vsearch: '',
            edit_mode: false,
            form: new Form({
                estate_id: '',
                estate_name: ''
            })
        }
    },
    methods: {
        getResults(page = 1) {
			axios.get('api/properties?page=' + page)
				.then(response => {
					this.properties = response.data;
				});
		},
        getProperties(){
            axios.get('api/properties').then(({ data})=>(this.properties = data));
        },
        searchV(){
            let query = this.vsearch;

            axios.get('api/findVehicle?q='+query)
            .then(({data})=>(
                this.properties = data
            ))
            .catch(()=>{

            })
            
        },
        createItem($item){
            this.$Progress.start();
            this.form.post('api/'+$item)
            .then(()=>{
                Toast.fire({
                    type: 'success',
                    title: $item+' details saved successfully.'
                })
                $('#modal-type').modal('hide');
                this.getItems($item);
            })
            .catch(()=>{
                Toast.fire({
                    type: 'warning',
                    title: $item+' details failed to save'
                })
                this.$Progress.fail();
            });
            this.$Progress.finish();
        },
        updateItem(){
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
    },
    created(){
        this.$Progress.start();
        this.getProperties();
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


