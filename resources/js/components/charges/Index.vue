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
                                SERVICE CHARGES
                            </div>
                            <div class="col-md-2">
                                <a href="#" @click.prevent="showCharge" class="btn btn-info btn-sm btn-flat">ADD NEW</a>
                            </div>                                                     
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped table-fixed">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Service  Charge</th>
                                    <th>Properties </th>
                                    <!-- <th>Amount</th> -->
                                    <th>Created</th>
                                    <!-- <th>Items</th> -->
                                    <th>Billable</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(d, index) in service_charges.data" :key="d.service_charge_id">
                                    <td>{{++index}}</td>
                                    <td> <a href="#" @click.prevent="updateCharge(d)" >{{d.service_charge}}</a> </td>
                                    <td>{{d.service_notes}}</td>
                                    <!-- <td></td> -->
                                    <td>{{d.created_at | moment('MM/DD/YYYY')}}</td>
                                    <td>{{d.billable == 1 ? 'YES' : 'NO'}}</td>
                                   
                                </tr>                                
                            </tbody>
                        </table>
                    </div>    
                    <div class="card-body">
                        <datatable
                                title="Basic table"
                                :columns="tableColumns1"
                                :rows="tableRows1"
/>
                    </div>                                
                </div>
            </div>
            
        </div>    
        <!-- modal window for updating content --> 
           <div class="modal fade show" id="modal-charge" style="display: none;" aria-modal="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <p class="modal-title" v-if="this.edit_mode == false">NEW SERVICE CHARGE</p>
                            <p class="modal-title" v-if="this.edit_mode == true">UPDATE SERVICE CHARGE</p>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form @submit.prevent="this.edit_mode ? updateServiceCharge() : createServiceCharge()" @keydown="form.onKeydown($event)" class="form-horizontal"> 
                            <div class="modal-body">
            
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>Create.</p>
                                        <hr>
                                    </div>
                                </div>    
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" >Service Charge:</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="form.service_charge" name="service_charge" class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('service_charge') }">
                                            <has-error :form="form" field="service_charge"></has-error>
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
                                        <textarea rows="5" v-model="form.service_notes" name="service_notes" id="service_notes" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('service_notes') }"></textarea>
                                            <has-error :form="form" field="service_notes"></has-error>
                                    </div>
                                </div>

                                
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                <button :disabled="form.busy" @click.prevent="edit_mode ? updateServiceCharge() : createServiceCharge()" class="btn btn-sm btn-success"><i class="fa fa-check"></i> SUBMIT</button>
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
        "datatable" : DataTable,
    },
    data() {
        return {
            service_charges: {},
            utilities: {},
            edit_mode: false,    
            tenant_name: '',    
            // driver_id: this.$route.params.id,
            vsearch: '',
            selected: '',
            properties: {},
            units: {},
            form: new Form({
                service_charge_id: '',               
                service_charge: '',
                service_notes: '',                
                billable: ''
            }),

            tableColumns1: [
			{
				label: "Character name",
				field: "charName",
				numeric: false,
				html: false
			},
			{
				label: "First appearance",
				field: "firstAppearance",
				numeric: false,
				html: false
			},
			{
				label: "Created by",
				field: "createdBy",
				numeric: false,
				html: false
			},
			{
				label: "Voiced by",
				field: "voicedBy",
				numeric: false,
				html: false
			}
		],
		tableRows1: [
			{
				charName: "Abu",
				firstAppearance: "Alladin (1992)",
				createdBy: "Joe Grant",
				voicedBy: "Frank Welker"
			},
			{
				charName: "Magic Carpet",
				firstAppearance: "Alladin (1992)",
				createdBy: "Randy Cartwright",
				voicedBy: "N/A"
			},
			{
				charName: "The Sultan",
				firstAppearance: "Alladin (1992)",
				createdBy: "Navid Negahban",
				voicedBy: "Douglas Seale"
			}
		],
	
        }
    },
    methods: {
        getResults(page = 1) {
			axios.get('api/service_charges?page=' + page)
				.then(response => {
					this.service_charges = response.data;
				});
		},
        getServiceCharges(){
            axios.get('api/service_charges').then(({ data})=>(this.service_charges = data));
        },       
        
        showCharge(){
            this.edit_mode = false;
            this.form.reset();
            $('#modal-charge').modal('show');
        },        
        updateCharge(d){
            this.edit_mode = true;
            this.form.reset();
            $('#modal-charge').modal('show');            
            this.form.fill(d);
        },     
        
        createServiceCharge(){
            this.$Progress.start();
            this.form.post('api/service_charges')
            .then(()=>{
                Toast.fire({
                    type: 'success',
                    title: 'Property type details saved successfully.'
                })
                $('#modal-charge').modal('hide');
                this.getServiceCharges();
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
        
        updateServiceCharge(){
            this.$Progress.start();
            this.form.put('api/service_charges/'+this.form.service_charge_id)
            .then(()=>{
                Toast.fire({
                    type: 'success',
                    title: 'Property type details saved successfully.'
                })
                $('#modal-charge').modal('hide');
                this.getServiceCharges();
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
        this.getServiceCharges();
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
