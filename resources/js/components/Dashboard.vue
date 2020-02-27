<template>
    <div class="container">
       
        <div class="row">
            <div class="col-md-12">
                  <div class="card-body">
                        <datatable
                                title="New Receipts"
                                :columns="tableColumns1"
                                :rows="tableRows1"/>                            
            </div>
        </div>
            
    </div>    
          
          
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
