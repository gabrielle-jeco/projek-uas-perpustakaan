<script setup lang="ts">
    import MyNavbar from '@/components/MyNavbar.vue';
    import {ref, reactive} from 'vue'
    import { useUserStore } from '@/stores/session';
    import axios from 'axios'

    axios.defaults.withCredentials = true

    const judul=ref('')
    const store = useUserStore()
    const token = store.data.token
    const results = ref(null)
    const books = reactive({
        'judul': '',
        'pengarang': '',
        'penerbit': '',
        'tahun_terbit': ''
    })
    const err = ref('')
    const config = {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer '+token
    }
    function cariBuku(){
        books.judul = ''
        books.pengarang = ''
        books.penerbit = ''
        books.tahun_terbit = ''
        err.value=''
        const url = 'http://127.0.0.1:8000/api/show/'+judul.value
        axios({
            'url': url,
            'method': 'get',
            'headers': config
        }).then(response=>{
            results.value = response.data
            books.judul = results.value.data.judul
            books.pengarang = results.value.data.pengarang
            books.penerbit = results.value.data.penerbit
            books.tahun_terbit = results.value.data.tahun_terbit
            judul.value=''
        }).catch(error=>{
            console.log('something went wrong')
            err.value='buku tidak ditemukan!'
            judul.value=''
        }).finally()
    }
</script>

<template>
    <MyNavbar/>
    <h1>Cari Buku</h1>
    <label for="cari">Masukkan judul buku: </label>
    <input type="text" id="cari" v-model="judul">
    <br>
    <ol>
        <li>
            Judul: {{ books.judul }} <br>
            Pengarang: {{ books.pengarang }} <br>
            Penerbit: {{ books.penerbit }} <br>
            Tahun terbit: {{ books.tahun_terbit }}
        </li>
    </ol>
    <h3>{{ err }}</h3>
    <button type="button" @click="cariBuku">Cari</button>
</template>