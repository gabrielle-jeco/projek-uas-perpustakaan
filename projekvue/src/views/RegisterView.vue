<script setup>
    import {ref, computed} from 'vue'
    import { useUserStore } from '@/stores/session';
    import { useRouter } from 'vue-router';
    import axios from 'axios'

    axios.defaults.withCredentials = true

    const username = ref('')
    const email = ref('')
    const password = ref('')
    const res = ref(null)
    const store = useUserStore()
    const route = useRouter()
    const err = ref('')
    const params = computed(()=>{
        return {
            'username': username.value,
            'email': email.value,
            'password': password.value
        }
    })
    const config = {
        'Content-Type': 'application/json'
    }

    function register(){
        err.value=''
        axios({
            'url': 'http://127.0.0.1:8000/api/register',
            'method': 'post',
            'data': params.value,
            'headers': config
        }).then(response=>{
            res.value = response.data
            if(res.value.success == true){
                store.data.email = email.value
                store.data.token = res.value.data
                route.push('/')
            }
        }).catch(error=>{
            console.log(`something went wrong`)
            err.value = 'register failed'
        })
    }
</script>

<template>
    <h1>Register here</h1>
    <label for="username">Username: </label>
    <input type="text" id="username" required v-model="username">
    <br>
    <label for="email">Email: </label>
    <input type="email" id="email" required v-model="email">
    <br>
    <label for="password">Password: </label>
    <input type="password" id="password" required v-model="password">
    <br>
    <h3>{{ err }}</h3>
    <button type="button" @click="register">Register</button>
    <p>Already registered? <RouterLink to="/">Login here</RouterLink></p>
    <RouterView/>
</template>