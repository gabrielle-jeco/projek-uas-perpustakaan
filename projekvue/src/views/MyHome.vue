<script setup>
    import {ref} from 'vue'
    import { useUserStore } from '@/stores/session'
    import { useRouter } from 'vue-router'
    import axios from 'axios'
    import MyNavbar from '@/components/MyNavbar.vue'

    axios.defaults.withCredentials = true

    const store = useUserStore()
    const token = store.data.token
    const route = useRouter()
    const res = ref(null)
    const config = {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer '+token
    }

    function logout(){
        axios({
            'url': 'http://127.0.0.1:8000/api/logout',
            'method': 'get',
            'headers': config
        }).then(response=>{
            res.value = response.data
            if(res.value.success == true){
                store.reset()
                route.push('/')
            }
        })
    }
</script>

<template>
    <MyNavbar/>
    <h1>welcome, {{ store.data.email }}</h1>
    <h3>Book management system</h3>
    <p>Here you can:</p>
    <ul>
        <li>View all book</li>
        <li>Find a book</li>
        <li>Add new book</li>
        <li>Edit existing book</li>
        <li>Delete a book</li>
    </ul>
    <p>Explore, enjoy!</p>
    <br>
    <h3>Logout Account</h3>
    <button type="button" @click="logout">Logout</button>
</template>