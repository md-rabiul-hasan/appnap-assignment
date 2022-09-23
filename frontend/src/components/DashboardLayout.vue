<template>
  <div>
     <Loader v-if="loader"/>

    <!-- Navbar-->
    <header class="app-header">
      <a class="app-header__logo" href="index.html">Appnap</a>
      <!-- Sidebar toggle button--><a
        class="app-sidebar__toggle"
        href="#"
        data-toggle="sidebar"
        aria-label="Hide Sidebar"
      ></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
  
        <!-- User Menu-->
        <li class="dropdown">
          <a
            class="app-nav__item"
            href="#"
            data-toggle="dropdown"
            aria-label="Open Profile Menu"
            ><i class="fa fa-user fa-lg"></i
          ></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li>
              <a class="dropdown-item" href="#" @click="handleLogout"
                ><i class="fa fa-sign-out fa-lg"></i> Logout</a
              >
            </li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user">
        <!-- <img 
          class="app-sidebar__user-avatar"
          src=https://scontent.fdac127-1.fna.fbcdn.net/v/t39.30808-6/295447150_3285546875061816_7449359173750454121_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=8bfeb9&_nc_eui2=AeGXIrinH-gk2mO8SYt_u6csPdqSu5V8dp492pK7lXx2nlLx7AHns-1HItp8V3xo5jxIeiu1F3NHf-svlaBVHt4O&_nc_ohc=_PzczJN9-3oAX9m_mz5&_nc_ht=scontent.fdac127-1.fna&oh=00_AT8JNbzHN1kR6kE1J9QT-ywTBTY0ttt_VmOhAKGLA2wqJQ&oe=6303824A'
          alt="User Image"
        /> -->
        <div>
          <p class="app-sidebar__user-name">{{ user.name }}</p>
          <p class="app-sidebar__user-designation">{{ user.email }}</p>
        </div>
      </div>
      <ul class="app-menu">
        <li>
          <router-link class="app-menu__item" to="/">
            <i class="app-menu__icon fa fa-dashboard"></i>
          <span class="app-menu__label">Dashboard</span>
          </router-link>
        </li>
        <li>
          <router-link class="app-menu__item" to="categories">
            <i class="app-menu__icon fa fa-snowflake-o"></i>
            <span class="app-menu__label">Category</span>
          </router-link>
        </li>
        <li>
          <router-link class="app-menu__item" to="products">
            <i class="app-menu__icon fa fa-gift"></i
            ><span class="app-menu__label">Product</span>
          </router-link>
        </li>
      </ul>
    </aside>

    <router-view></router-view>

  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import Vue from 'vue';
import axios from 'axios';
import Loader from './common/Loader.vue';
export default {
    name: "DashboardScreen",
    methods: {
        handleLogout() {
            localStorage.removeItem("token");
            Vue.$toast.open({
                message: "Logout successfully",
                type: "success",
                position: "top"
            });
            this.$store.dispatch("user", null);
            this.$router.push("login");
        }
    },
    async created() {
      const token = localStorage.getItem("token");
      if(token){      
        // this.$store.dispatch("loader", true);
        try {
            const response = await axios.get("/auth/user-info");           
            this.$store.dispatch("loader", false);
            this.$store.dispatch("user", response.data.data);
        }
        catch (error) {
          this.$store.dispatch("loader", false);
            console.log(error);
        }
      }else{
        this.$router.push("/login")
      }

    },
    computed: {
        ...mapGetters(["user", "loader"])
    },
    components: { Loader }
};
</script>

<style scoped>
</style>