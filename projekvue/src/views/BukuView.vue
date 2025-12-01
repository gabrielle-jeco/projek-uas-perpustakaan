<script setup lang="ts">
    import MyNavbar from '@/components/MyNavbar.vue';
    import {ref} from 'vue'
    import { useUserStore } from '@/stores/session'
    import axios from 'axios'

    axios.defaults.withCredentials = true

    const store = useUserStore()
    const token = store.data.token
    const results = ref(null)
    const books = ref(null)
    const err = ref('')
    const config = {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer '+token
    }

    axios({
        'url': 'http://127.0.0.1:8000/api/show-all',
        'method': 'get',
        'headers': config
    }).then(response=>{
        results.value = response.data
        books.value = results.value.data
    }).catch(error=>{
        console.log('something went wrong')
        err.value=results.value.message
    }).finally()
</script>

<template>
    <MyNavbar/>
    <h1>View all book</h1>
    <ol>
        <li v-for="(item) in books">
            judul: {{ item.judul }} <br>
            pengarang: {{ item.pengarang }} <br>
            penerbit: {{ item.penerbit }} <br>
            tahun terbit: {{ item.tahun_terbit }} <br> <br>
        </li>
    </ol>
    <h3>{{ err }}</h3>
</template>