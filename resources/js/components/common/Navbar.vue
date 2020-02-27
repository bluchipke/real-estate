<template>
    <div class="col-md-10 mb-2 mt-2" v-show="$gate.isAdminOrAccounts()">
        <ul class="nav nav-pills">
            <li class="nav-item"><router-link class="nav-link" :to="'/properties/'+property_id+'/show'">DETAILS</router-link></li>
            <li class="nav-item"><router-link class="nav-link" :to="'/properties/'+property_id+'/units'">UNITS</router-link></li>
            <!-- <li class="nav-item"><router-link class="nav-link" :to="'/drivers/'+property_id+'/trips'">TRIPS</router-link></li> 
            <li class="nav-item"><router-link class="nav-link" :to="'/drivers/'+property_id+'/collections'">COLLECTIONS</router-link></li>          
            <li class="nav-item"><router-link class="nav-link" :to="'/drivers/'+property_id+'/commissions'">COMMISSIONS</router-link></li>
            <li class="nav-item"><router-link class="nav-link" :to="'/drivers/'+property_id+'/schedules'">SCHEDULES</router-link></li> -->
        </ul>
    </div>
</template>
<script>
export default {
    data(){
        return{
            driver: '',
            property_id: this.$route.params.id
        }
    }

}
</script>
<style scoped>
.router-link-exact-active {
    color: #ffffff;
}
</style>


