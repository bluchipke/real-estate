<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-5">
                                LANDLORDS
                            </div>                            
                            <!-- <div class="col-md-2"></div> -->
                            <div class="col-md-5">
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
                                <router-link to="/landlords/create" class="btn btn-sm btn-primary btn-flat">NEW LANDLORD</router-link>
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
                                    <th>Email</th>
                                    <th>Properties</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, index) in landlords.data" :key="v.landlord_id">
                                    <td>{{++index}}</td>
                                    <td><router-link :to="'/landlords/'+v.landlord_id+'/show'">{{v.landlord_name}}</router-link></td>
                                    <td>{{v.phone_number}}</td>
                                    <td>{{v.email_address}}</td>
                                    <td><h6 style="text-align: right;"><a href="#">{{v.ls}}</a></h6></td>
                                    <td>
                                        {{!null ? v.postal_code : ''}}, {{ !null ? v.postal_address: ''}}
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="landlords" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
            </div>            
        </div>    
    </div>    
</template>
<script>
export default {
    data() {
        return {
            landlords: {},
            vsearch: ''
        }
    },
    methods: {
        getResults(page = 1) {
			axios.get('api/landlords?page=' + page)
				.then(response => {
					this.landlords = response.data;
				});
		},
        getLandlords(){
            axios.get('api/landlords').then(({ data})=>(this.landlords = data));
        },
        searchV(){
            let query = this.vsearch;

            axios.get('api/findVehicle?q='+query)
            .then(({data})=>(
                this.landlords = data
            ))
            .catch(()=>{

            })
            
        }
    },
    created(){
        this.$Progress.start();
        this.getLandlords();
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


