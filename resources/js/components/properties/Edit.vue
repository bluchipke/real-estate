<template>
    <div class="contai">
        <div class="row justify-content-center" v-show="$gate.isAdminOrAccounts()">          
          <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    PROPERTY DETAILS
                </div>
                <div class="card-body">
                    <form @submit.prevent="updateProperty" @keydown="form.onKeydown($event)">
                        
                    <div class="row">
                        <fieldset class="col-md-12">
                            <legend><h5>General Information</h5></legend>
                                <div class="row">                                    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">Property</label>
                                        <input v-model="form.property_name" type="text" name="property_name" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('property_name') }">
                                        <has-error :form="form" field="property_name"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label">Property Type</label>
                                        <select v-model="form.property_type_id" type="text" name="property_type_id" class="form-control" :class="{ 'is-invalid': form.errors.has('property_type_id') }">
                                            <option value="">Select</option>
                                            <option v-for="str in property_types.data" :key="str.property_type_id" :value="str.property_type_id">{{str.property_type_name}}</option>                                    
                                        </select>
                                        <has-error :form="form" field="property_type_id"></has-error>
                                    </div>
                                     <div class="form-group">
                                        <label for="" class="form-label">Main Street</label>
                                        <input v-model="form.main_street" type="text" name="main_street" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('main_street') }">
                                        <has-error :form="form" field="main_street"></has-error>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="" class="form-label">Location</label>
                                        <select v-model="form.location_id" type="text" name="location_id" class="form-control" :class="{ 'is-invalid': form.errors.has('location_id') }">
                                            <option value="">Select</option>
                                            <option v-for="str in locations.data" :key="str.location_id" :value="str.location_id">{{str.location_name}}</option>
                                        </select>
                                        <has-error :form="form" field="location_id"></has-error>
                                    </div>
                                     <div class="form-group">
                                        <label for="" class="form-label">Estate</label>
                                        <select v-model="form.estate_id" type="text" name="estate_id" class="form-control" :class="{ 'is-invalid': form.errors.has('estate_id') }">
                                            <option value="">Select</option>
                                            <option v-for="str in estates.data" :key="str.estate_id" :value="str.estate_id">{{str.estate_name}}</option>
                                        </select>
                                        <has-error :form="form" field="estate_id"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label">Property Landlord</label>
                                        <select v-model="form.landlord_id" type="text" name="landlord_id" class="form-control" :class="{ 'is-invalid': form.errors.has('landlord_id') }">
                                            <option value="">Select</option>
                                            <option v-for="str in landlords.data" :key="str.landlord_id" :value="str.landlord_id">{{str.first_name+' '+str.last_name}}</option>  
                                        </select>
                                        <has-error :form="form" field="landlord_id"></has-error>
                                    </div>
                                </div>   
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">Plot Number:</label>
                                        <input v-model="form.plot_number" type="text" name="plot_number" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('plot_number') }">
                                        <has-error :form="form" field="plot_number"></has-error>
                                    </div>
                                     <div class="form-group">
                                        <label for="" class="form-label">Constituency</label>
                                        <input v-model="form.constituency" type="text" name="constituency" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('constituency') }">
                                        <has-error :form="form" field="constituency"></has-error>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">No of Units:</label>
                                        <input v-model="form.units_count" type="text" name="units_count" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('units_count') }">
                                        <has-error :form="form" field="units_count"></has-error>
                                    </div>
                                     <div class="form-group">
                                        <label for="" class="form-label">Number of Floors:</label>
                                        <input v-model="form.no_floors" type="text" name="no_floors" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('no_floors') }">
                                        <has-error :form="form" field="no_floors"></has-error>
                                    </div>
                                </div>    
                            </div>                        
                        </fieldset>
                    </div>
                    <div class="row">
                        <div class="col-md-2" style="padding-left: 8px !important;">
                            <button :disabled="form.busy" type="submit" class="btn btn-md btn-block btn-flat btn-success"> <i class="fa fa-check"></i> SAVE </button>
                        </div>
                    </div>                 
                       
                    </form>
                </div>
            </div>
          </div>
          <div class="col-md-4">             
             <div class="row">
                 <div class="col-md-12">
                     <div class="card">
                         <div class="card-header">
                             FEATURES
                         </div>
                         <div class="card-body">
                             <div class="row">
                                 <div class="col-md-12">
                                    <a href="#">Generate Unit IDs</a>
                                 </div>
                                 <div class="col-md-12">
                                    <a href="#">Property Features</a>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
              
          </div>
        </div>
        <div v-show="!$gate.isAdminOrAccounts()">
            <not-found></not-found>
        </div>

        <!-- modal window for location --> 
           <div class="modal fade show" id="modal-location" style="display: none;" aria-modal="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title" v-if="this.edit_mode == false">CREATE</span>
                            <span class="modal-title" v-if="this.edit_mode == true">EDIT</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form @submit.prevent="edit_mode ? updateItem('location') : createItem('location')" @keydown="form.onKeydown($event)" class="form-horizontal"> 
                            <div class="modal-body">
            
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Location</h5>
                                        <hr>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" >Description:</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="form.location_name" name="location_name" class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('location_name') }">
                                            <has-error :form="form" field="location_name"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" style="text-transform: capitalize;">Notes:</label>
                                        <div class="col-md-9">
                                        <textarea type="text" v-model="form.loc_notes" name="loc_notes" id="loc_notes" class="form-control" rows="5" :class="{ 'is-invalid': form.errors.has('loc_notes') }"></textarea>
                                            <has-error :form="form" field="loc_notes"></has-error>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                <button :disabled="form.busy" type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> SUBMIT</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
         <!-- end of modal-->

         <!-- modal window for estate --> 
           <div class="modal fade show" id="modal-estate" style="display: none;" aria-modal="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title" v-if="this.edit_mode == false">CREATE</span>
                            <span class="modal-title" v-if="this.edit_mode == true">EDIT</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form @submit.prevent="edit_mode ? updateItem('estate') : createItem('estate')" @keydown="form.onKeydown($event)" class="form-horizontal"> 
                            <div class="modal-body">
            
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Estate</h5>
                                        <hr>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" >Description:</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="form.estate_name" name="estate_name" class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('estate_name') }">
                                            <has-error :form="form" field="estate_name"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" style="text-transform: capitalize;">Notes:</label>
                                        <div class="col-md-9">
                                        <textarea type="text" v-model="form.estate_notes" name="estate_notes" id="estate_notes" class="form-control" rows="5" :class="{ 'is-invalid': form.errors.has('estate_notes') }"></textarea>
                                            <has-error :form="form" field="estate_notes"></has-error>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                <button :disabled="form.busy" type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> SUBMIT</button>
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

        return{
            property_types: {},
            estates: {},
            locations: {},
            landlords: {},
            property_id: this.$route.params.id,
            edit_mode: false,
            form: new Form({
                landlord_id:'',
                property_name: '',
                main_street: '',
                property_type_id: '',
                location_id: '',
                estate_id: '',
                units_count: '',
                no_floors: '',
                plot_number: '',
                constituency: '',
                phone_number: '',
                county: '',
                location_name: '',
                loc_notes: '',
                estate_name: '',
                estate_notes: '',
            })
        }
    },
    methods: {

        updateProperty(){
            this.form.put('api/properties/'+this.property_id).then(()=>{
                Toast.fire({
                    type: 'success',
                    title: 'Property details updated.'
                })
                // this.form.reset();
            })
            .catch(()=>{
                Toast.fire({
                    type: 'warning',
                    title: 'Property details failed to update.'
                })
            });
        },
        getPropertyTypes(){
            axios.get('api/property_types').then(({ data})=>(this.property_types = data));
        },
        getLocations(){
            axios.get('api/locations').then(({ data})=>(this.locations = data));
        },
        getLandlords(){
            axios.get('api/landlords').then(({ data})=>(this.landlords = data));
        },
        getEstates(){
            axios.get('api/estates').then(({ data})=>(this.estates = data));
        },
        getProperty(){
            axios.get('api/properties/'+this.property_id).then(({data})=>(
                this.form.fill(data)
            ));
        },
        showItem($item){
            this.form.reset();
            $('#modal-'+$item).modal('show');
        },
        updateLocation(){
            console.log('Update clicked');
        },
        createLocation(){
            console.log('Create clicked');
        },
        createItem($item){
            this.$Progress.start();
            this.form.post('api/'+$item+'s')
            .then(()=>{
                Toast.fire({
                    type: 'success',
                    title: $item+' details saved successfully.'
                })
                $('#modal-'+$item).modal('hide');
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
        getItems($item){
            if($item == 'estate'){
                this.getEstates();

            }else if($item == 'location'){

                this.getLocations();
            }else if($item == 'landlord'){

                this.getLandlords();
            }
        }
    },
    created(){
        this.$Progress.start();        
        this.getPropertyTypes();
        this.getEstates();
        this.getLocations();
        this.getLandlords();
        this.getProperty();
        this.$Progress.finish();
    }
    
}
</script>

<style scoped>
    fieldset { border:1px solid #c2c2c2; margin: 5px; border-radius: 3px; }
    .form-control{ border-radius: 0px; }

    legend {
        padding: 0.2em 0.5em;
        /* border:1px solid #c2c2c2; */
        color:#070707;
        font-size:90%;
        text-align:left;
        width: auto;
    }

    .form-control-sm {
        height: calc(1.0em + 0.5rem + 2px);
        padding: 0.75rem 0.5rem;
    }
    label:not(.form-check-label):not(.custom-file-label) {
        font-weight: 500;
    }
    label {
        margin-bottom: 0.2rem;
        color: #245d73;
    }
    .form-group {
        margin-bottom: 0.5rem;
    }
    h5, .h5 {
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 0rem;
    }
</style>


