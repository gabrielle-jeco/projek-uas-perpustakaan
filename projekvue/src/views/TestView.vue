<script setup>
    import { ref } from 'vue';
    import axios from 'axios';
import MyNavbar from '@/components/MyNavbar.vue';

    axios.defaults.withCredentials = true

    const data = ref('')
    const msg=ref('')
    const res=ref(null)
    const config={
        'Content-Type': 'application/json'
    }

    axios({
        'url':'http://127.0.0.1:8000/api/test',
        'method': 'get',
        'headers': config
    }
    ).then(response=>{
        res.value = response.data
        if(res.value.success == true){
            data.value=res.value.data
            msg.value=res.value.message
        }
    }).catch(error=>{
        console.log(error)
        data.value='no data'
        msg.value='test failed'
    })
</script>

<template>
    <MyNavbar/>
    <h1>Test data: {{ data }}</h1>
    <h1>Test msg: {{ msg }}</h1>
</template>