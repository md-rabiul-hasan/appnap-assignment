<template>
    <main class="app-content">
        <p>Edit Category List</p>
    </main>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
    name: "AddCategory",
    computed:{
        ...mapGetters(['user'])
    }
}
</script>

<style scoped>
    
</style>