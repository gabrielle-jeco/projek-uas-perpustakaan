<script setup lang="ts">
    import MyNavbar from '@/components/MyNavbar.vue';
    import {ref,computed,reactive} from 'vue'
    import { useUserStore } from '@/stores/session';
    import axios from 'axios';

    const judulAsli=ref('')
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

    function editBuku(){
        err.value=''
        axios({
            'url': 'http://127.0.0.1:8000/api/edit/'+judulAsli.value,
            'method': 'post',
            'data': params.value,
            'headers': config
        }).then(response=>{
            res.value=response.data
            if(res.value.success==true){
                err.value='Buku berhasil diedit'
                judul.value=''
                pengarang.value=''
                penerbit.value=''
                tahun_terbit.value=''
            }
        }).catch(error=>{
            console.log(error)
            err.value='Gagal mengedit buku'
            judul.value=''
            pengarang.value=''
            penerbit.value=''
            tahun_terbit.value=''
        })
    }

    const cari=ref('')
    const errcari=ref('')
    const results=ref(null)
    function cariBuku(){
        errcari.value=''
        const url = 'http://127.0.0.1:8000/api/show/'+cari.value
        axios({
            'url': url,
            'method': 'get',
            'headers': config
        }).then(response=>{
            results.value = response.data
            judulAsli.value = results.value.data.judul
            judul.value=judulAsli.value
            pengarang.value = results.value.data.pengarang
            penerbit.value = results.value.data.penerbit
            tahun_terbit.value = results.value.data.tahun_terbit
            cari.value=''
            errcari.value='buku ditemukan'
        }).catch(error=>{
            console.log('something went wrong')
            errcari.value='buku tidak ditemukan!'
            cari.value=''
        }).finally()
    }
</script>

<template>
    <MyNavbar/>
    <h1>Edit Buku</h1>
    <label for="caribuku">Masukkan judul buku: </label>
    <input type="text" id="caribuku" v-model="cari"><br>
    <h3>{{ errcari }}</h3>
    <button type="button" @click="cariBuku">Cari</button>
    <br><br>
    <label for="judul">Judul: </label>
    <input type="text" id="judul" v-model="judul"><br>
    <label for="pengarang">Pengarang: </label>
    <input type="text" id="pengarang" v-model="pengarang"><br>
    <label for="penerbit">Penerbit: </label>
    <input type="text" id="penerbit" v-model="penerbit"><br>
    <label for="tahun_terbit">Tahun terbit: </label>
    <input type="text" id="tahun_terbit" v-model="tahun_terbit"><br>
    <h3>{{ err }}</h3>
    <button type="button" @click="editBuku">Simpan Perubahan</button>
</template>