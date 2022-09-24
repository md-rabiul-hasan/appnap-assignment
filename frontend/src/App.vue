<template>
  <div id="app">
    <AuthLayout v-if="authenticationRoute.includes(this.$route.name) == true" />    
    <DashboardLayout v-else />
  </div>
</template>

<script>
import AuthLayout from './components/AuthLayout.vue'
import DashboardLayout from './components/DashboardLayout.vue';
// import axios from 'axios'
export default {
  name: 'App',
  components:{
    AuthLayout,
    DashboardLayout
  },
  async created(){
    const token = localStorage.getItem("token");
    if(!token){          
      this.$router.push("/");
    }        
  },
   computed: {
    authenticationRoute () {
      return ['register', 'login', 'forget-password', 'reset-password', 'home', 'product-details' ]
    }
  }
}
</script>
