<template>
  <div id="app">
    <h1>HELLO AYEAYE22222222222222222</h1>
    <form action="">
      <input type="text" v-model="one" name="one"><br><br>
      <input type="text" v-model="two" name="two"><br><br>
      <button type="button" v-on:click="input(one,two)">расasdadчитать aa</button>
    </form>
    {{result}}
  </div>
</template>

<script>

import axios from "axios";



export default {
  name: 'app',
  methods:{
    input: function (one, two) {
      this.$api.auth.input({
        one:one,
        two:two
      }).then(response => (this.result = response.data.result));

      // axios.post('http://symfonytest.local/vue',
      //     {
      //       one:one,
      //       two:two
      //     }).then(response => (this.result = response.data.result));

    }
  },
  data: function(){

    return {
      result: 0,
      one: 0,
      two: 0
    }

  }


}


</script>