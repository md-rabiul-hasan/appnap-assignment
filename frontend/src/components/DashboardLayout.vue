<template>
  <div>
     <Loader v-if="loader"/>

    <!-- Navbar-->
    <header class="app-header">
      <a class="app-header__logo" href="index.html">Vue Authentication</a>
      <!-- Sidebar toggle button--><a
        class="app-sidebar__toggle"
        href="#"
        data-toggle="sidebar"
        aria-label="Hide Sidebar"
      ></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <li class="app-search">
          <input class="app-search__input" type="search" placeholder="Search" />
          <button class="app-search__button">
            <i class="fa fa-search"></i>
          </button>
        </li>
        <!--Notification Menu-->
        <li class="dropdown">
          <a
            class="app-nav__item"
            href="#"
            data-toggle="dropdown"
            aria-label="Show notifications"
            ><i class="fa fa-bell-o fa-lg"></i
          ></a>
          <ul class="app-notification dropdown-menu dropdown-menu-right">
            <li class="app-notification__title">
              You have 4 new notifications.
            </li>
            <div class="app-notification__content">
              <li>
                <a class="app-notification__item" href="javascript:;"
                  ><span class="app-notification__icon"
                    ><span class="fa-stack fa-lg"
                      ><i class="fa fa-circle fa-stack-2x text-primary"></i
                      ><i
                        class="fa fa-envelope fa-stack-1x fa-inverse"
                      ></i></span
                  ></span>
                  <div>
                    <p class="app-notification__message">
                      Lisa sent you a mail
                    </p>
                    <p class="app-notification__meta">2 min ago</p>
                  </div></a
                >
              </li>
              <li>
                <a class="app-notification__item" href="javascript:;"
                  ><span class="app-notification__icon"
                    ><span class="fa-stack fa-lg"
                      ><i class="fa fa-circle fa-stack-2x text-danger"></i
                      ><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span
                  ></span>
                  <div>
                    <p class="app-notification__message">
                      Mail server not working
                    </p>
                    <p class="app-notification__meta">5 min ago</p>
                  </div></a
                >
              </li>
              <li>
                <a class="app-notification__item" href="javascript:;"
                  ><span class="app-notification__icon"
                    ><span class="fa-stack fa-lg"
                      ><i class="fa fa-circle fa-stack-2x text-success"></i
                      ><i class="fa fa-money fa-stack-1x fa-inverse"></i></span
                  ></span>
                  <div>
                    <p class="app-notification__message">
                      Transaction complete
                    </p>
                    <p class="app-notification__meta">2 days ago</p>
                  </div></a
                >
              </li>
              <div class="app-notification__content">
                <li>
                  <a class="app-notification__item" href="javascript:;"
                    ><span class="app-notification__icon"
                      ><span class="fa-stack fa-lg"
                        ><i class="fa fa-circle fa-stack-2x text-primary"></i
                        ><i
                          class="fa fa-envelope fa-stack-1x fa-inverse"
                        ></i></span
                    ></span>
                    <div>
                      <p class="app-notification__message">
                        Lisa sent you a mail
                      </p>
                      <p class="app-notification__meta">2 min ago</p>
                    </div></a
                  >
                </li>
                <li>
                  <a class="app-notification__item" href="javascript:;"
                    ><span class="app-notification__icon"
                      ><span class="fa-stack fa-lg"
                        ><i class="fa fa-circle fa-stack-2x text-danger"></i
                        ><i
                          class="fa fa-hdd-o fa-stack-1x fa-inverse"
                        ></i></span
                    ></span>
                    <div>
                      <p class="app-notification__message">
                        Mail server not working
                      </p>
                      <p class="app-notification__meta">5 min ago</p>
                    </div></a
                  >
                </li>
                <li>
                  <a class="app-notification__item" href="javascript:;"
                    ><span class="app-notification__icon"
                      ><span class="fa-stack fa-lg"
                        ><i class="fa fa-circle fa-stack-2x text-success"></i
                        ><i
                          class="fa fa-money fa-stack-1x fa-inverse"
                        ></i></span
                    ></span>
                    <div>
                      <p class="app-notification__message">
                        Transaction complete
                      </p>
                      <p class="app-notification__meta">2 days ago</p>
                    </div></a
                  >
                </li>
              </div>
            </div>
            <li class="app-notification__footer">
              <a href="#">See all notifications.</a>
            </li>
          </ul>
        </li>
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
          <a class="app-menu__item active" href="dashboard.html"
            ><i class="app-menu__icon fa fa-dashboard"></i
            ><span class="app-menu__label">Dashboard</span></a
          >
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
        this.$store.dispatch("loader", true);
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