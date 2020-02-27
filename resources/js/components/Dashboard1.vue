<template>
    <div class="container">
        <p>Insufficient data to generate any analytical reports</p>
    </div>
</template>

<script>
    export default {
      data() {

        return {
          trips: 0,
        }
      },

      methods: {
            getCurrentTrips(){
              axios.get('api/driver/trips')
              .then(({data})=>(
                  this.trips = data
              ))
              .catch(()=>{
                  Toast.fire({
                      type: 'warning',
                      title: 'An error occurred. Could not retrieve records.'
                  })
              })            
          },
          getOpenChedule(){

          }
      },
        mounted() {
            this.$Progress.start();
            this.getCurrentTrips();
            this.$Progress.finish();
        }
    }
</script>
