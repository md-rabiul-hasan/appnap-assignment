<template>
    <main class="app-content">
        <p>Welcome To My world {{ user.name }}</p>
    </main>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
    name: "HomeScreen",
    computed:{
        ...mapGetters(['user'])
    }
}
</script>

<style scoped>
    
</style>