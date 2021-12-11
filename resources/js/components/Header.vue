<template>
  <div class="container">
      <div class="row">
          <div class="col-12">
              <h3>My todo’s ({{number}})</h3>
                

          </div>

      </div>
  </div>
</template>

<script>
import {mapGetters} from 'vuex'

export default {
    
    computed : {
        ...mapGetters({
            number : 'getTodosNumber'
        })
    }

}
</script>

<style>

</style>