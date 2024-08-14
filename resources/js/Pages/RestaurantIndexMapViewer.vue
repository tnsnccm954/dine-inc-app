<script>
import Layout from '@/layouts/CardViewerLayout.vue'

export default {
  layout: Layout,
  mounted() {
    // Assign slot props when the component is mounted
    // console.log(this)
    setTimeout(()=>{
      
    },1000)
    setTimeout(()=>{

    },2000)
  },
}

</script>

<template v-slot="isFetching" >
  <h1>{{ isFetching }}</h1>
  <h1>1-1</h1>
  
  <!-- <h1>{{ slotProps?.isFetching }}</h1> -->
</template>