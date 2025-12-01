<script setup lang="ts">
    import MyNavbar from '@/components/MyNavbar.vue';
    import { useUserStore } from '@/stores/session';
    import axios from 'axios'
    import { ref } from 'vue';

    axios.defaults.withCredentials = true

    const hapus=ref('')
    const store = useUserStore()
    const token = store.data.token
    const results = ref(null)
    const err = ref('')
    const config = {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer '+token
    }
    function hapusBuku(){
        err.value=''
        const url = 'http://127.0.0.1:8000/api/delete/'+hapus.value
        axios({
            'url': url,
            'method': 'get',
            'headers': config
        }).then(response=>{
            results.value = response.data
            if(results.value.success == true){
                err.value='buku berhasil dihapus'
                hapus.value=''
            }
        }).catch(error=>{
            console.log('something went wrong')
            err.value='buku tidak ditemukan!'
            hapus.value=''
        }).finally()
    }
</script>

<template>
    <MyNavbar/>
    <h1>Hapus Buku</h1>
    <label for="delete">Masukkan judul buku: </label>
    <input type="text" id="delete" v-model="hapus">
    <br>
    <h3>{{ err }}</h3>
    <button type="button" @click="hapusBuku">Hapus</button>
</template>