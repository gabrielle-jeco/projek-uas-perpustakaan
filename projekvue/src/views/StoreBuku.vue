<script setup lang="ts">
    import MyNavbar from '@/components/MyNavbar.vue';
    import { useUserStore } from '@/stores/session';
    import { ref, computed } from 'vue';
    import axios from 'axios';

    axios.defaults.withCredentials = true

    const judul=ref('')
    const pengarang=ref('')
    const penerbit=ref('')
    const tahun_terbit=ref('')
    const store=useUserStore()
    const err=ref('')
    const res=ref(null)
    const token=store.data.token
    const params=computed(()=>{
        return {
            'judul':judul.value,
            'pengarang':pengarang.value,
            'penerbit':penerbit.value,
            'tahun_terbit':tahun_terbit.value
        }
    })
    const config={
        'Content-Type':'application/json',
        'Authorization': 'Bearer '+token
    }

    function tambahBuku(){
        err.value=''
        axios({
            'url': 'http://127.0.0.1:8000/api/store',
            'method': 'post',
            'data': params.value,
            'headers': config
        }).then(response=>{
            res.value=response.data
            if(res.value.success==true){
                err.value='Buku ditambahkan'
                judul.value=''
                pengarang.value=''
                penerbit.value=''
                tahun_terbit.value=''
            }
        }).catch(error=>{
            console.log(error)
            err.value='Gagal menambahkan buku'
            judul.value=''
            pengarang.value=''
            penerbit.value=''
            tahun_terbit.value=''
        })
    }

</script>

<template>
    <MyNavbar/>
    <h1>Tambah Buku Baru</h1>
    <label for="judul">Judul: </label>
    <input type="text" id="judul" v-model="judul"><br>
    <label for="pengarang">Pengarang: </label>
    <input type="text" id="pengarang" v-model="pengarang"><br>
    <label for="penerbit">Penerbit: </label>
    <input type="text" id="penerbit" v-model="penerbit"><br>
    <label for="tahun_terbit">Tahun terbit: </label>
    <input type="text" id="tahun_terbit" v-model="tahun_terbit"><br>
    <h3>{{ err }}</h3>
    <button type="button" @click="tambahBuku">Tambah</button>
</template>