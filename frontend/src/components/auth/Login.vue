<template>
  <div class="login-box"> 
    <form class="login-form" @submit.prevent="handleLoginSubmit">
      <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>

       <Error  v-if="error" :error="error" />

      <div class="form-group">
        <label class="control-label">Email</label>
        <input class="form-control" type="text" v-model="email" placeholder="Email" autofocus />
      </div>
      <div class="form-group">
        <label class="control-label">PASSWORD</label>
        <input class="form-control" type="password" v-model="password" placeholder="Password" />
      </div>
      <div class="form-group">
        <div class="utility">
          <div class="animated-checkbox">
            <label>
              <input type="checkbox" /><span class="label-text"
                >Stay Signed in</span
              >
            </label>
          </div>
          <p class="semibold-text mb-2">
            <router-link  to="forget-password">Forgot Password ?</router-link>
          </p>
        </div>
      </div>
      <div class="form-group btn-container">
        <button type="submit" class="btn btn-primary btn-block">
          <i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN
        </button>
      </div> <div class="form-group">
        <div class="utility">
          <p class="semibold-text mb-2">
            <router-link to="register">Create new account ?</router-link>
          </p>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import axios from 'axios'
import Vue from 'vue';
import Error from '../common/Error.vue';
export default {
    name: "LoginScreen",
    data() {
        return {
            email: "",
            password: "",
            error: ""
        };
    },
    methods: {
        async handleLoginSubmit() {
          this.$store.dispatch("loader", true);
            const data = {
                email: this.email,
                password: this.password
            };
            try {
                const response = await axios.post("/auth/login", data);
                this.$store.dispatch("loader", false);
                Vue.$toast.open({
                  message: response.data.message,
                  type: "success",
                  position: 'top'
                });

                this.$store.dispatch("user", response.data.data);
                localStorage.setItem("token", response.data.data.token);
                this.$router.push("/");
            }
            catch (error) {
              this.$store.dispatch("loader", false);
                this.error = error.message;
                console.log("error" + error.response.success);
            }
        }
    },
    components: { Error }
};
</script>

<style>
</style>