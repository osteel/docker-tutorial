<template>
  <div id="app">
    <HelloThere :msg="msg"/>
  </div>
</template>

<script>
import axios      from 'axios'
import HelloThere from './components/HelloThere.vue'

export default {
  name: 'App',
  components: {
    HelloThere
  },
  data () {
    return {
      msg: null
    }
  },
  mounted () {
    axios
      .get('https://backend.demo.test/api/hello-there')
      .then(response => (this.msg = response.data))
  }
}
</script>
