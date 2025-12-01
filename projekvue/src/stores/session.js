import { ref, computed } from 'vue'
import { defineStore } from 'pinia'
import { useStorage } from '@vueuse/core'

export const useUserStore = defineStore('user', ()=>{
    const obj = useStorage('userstore', {name:'', email:'', token:''});

    function reset(){
        obj.value = {name:'', email:'', token:''}
    }

    return {'data':obj, reset}
})