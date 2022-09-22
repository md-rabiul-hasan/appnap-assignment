<template>
  <div>
    <Loader v-if="loader"/>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="logo">
            <h1>Vue-Authentication</h1>
        </div> 

        <router-view></router-view>

    </section>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import Loader from './common/Loader.vue';
export default {
    name: "AuthLayout",
    computed: {
        ...mapGetters(["loader"])
    },
    components: { Loader }
};
</script>

<style>
</style>