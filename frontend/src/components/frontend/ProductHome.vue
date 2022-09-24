<template>
    <div>
        
    <header>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="#" class="navbar-brand d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
            <strong>Appnap</strong>
          </a>
          <div>
            <router-link :to="{ name: 'login' }" class="link" >Login</router-link>
            <router-link :to="{ name: 'register' }" class="link">Register</router-link>
          </div>
        </div>
      </div>
    </header>

    <main role="main">

      <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">Appnap Assignment</h1>
        </div>
      </section>

      <div class="album py-5 bg-light">
        <div class="container">

          <div class="row">
            <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="https://i.pinimg.com/originals/9a/e5/fd/9ae5fdfa8f1c6eb4d8e481a3beac636d.png" alt="Card image cap">
                <div class="card-body">
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                    </div>
                    <small class="text-muted">9 mins</small>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

    </main>
    </div>
</template>

<script>
import axios from 'axios';
import Vue from 'vue';
export default {
    name: "ProductHomeScreen",
    data(){
      return {
        products: [],
      }
    },
    methods:{
        async getProducts(){       
          this.$store.dispatch("loader", true);    
          const response = await axios.get("/products");
          this.$store.dispatch("loader", false); //loader off
          if(response.data.success === true){ // success request                 
            this.products = response.data.data
          }else{ // failed request
            Vue.$toast.open({
              message: response.data.message,
              type: "error",
              position: 'top'
            });
          }
        }


    },
    mounted() {
      this.getProducts();
    }
}
</script>

<style>
    .add_button {
        position: absolute;
        top: 5%;
        right: 5%;
    }
    .link {
        text-transform: uppercase;
        font-weight: bold;
        color: white;
        margin-right: 12px;
    }
</style>