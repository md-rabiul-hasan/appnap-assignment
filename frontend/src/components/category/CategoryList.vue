<template>
    <main class="app-content">
        <div class="col-md-6 offset-md-3">
          <div class="tile">
            <h3 class="tile-title">Category List</h3>
            <router-link to="/categories/create" class="add_button btn btn-primary" type="button"><i class="fa fa-plus-circle"></i>  Add New</router-link>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Created</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="category in categories" :key="category.id">
                  <td>{{ category.id }}</td>
                  <td>{{ category.name }}</td>                 
                  <td>{{ category.created_at }}</td>                 
                </tr>               
              </tbody>
            </table>
          </div>
        </div>
    </main>
</template>

<script>
import axios from 'axios';
import Vue from 'vue';
export default {
    name: "AddCategory",
    data(){
      return {
        categories: [],
      }
    },
    methods:{
        async getCategories(){       
          this.$store.dispatch("loader", true);    
          const response = await axios.get("/categories");
          this.$store.dispatch("loader", false); //loader off
          if(response.data.success === true){ // success request                  
            Vue.$toast.open({
              message: response.data.message,
              type: "success",
              position: 'top'
            });
            this.categories = response.data.data
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
      this.getCategories();
    }
}
</script>

<style scoped>

</style>