<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
export default {
    components : {
        Head , Link, AppLayout
    },
    props : ['user'],
    data(){
        return {
            notifys : [],
        }
    },
    methods : {
        async notificaiones(){
            await axios.get('/notificaciones').then(response => {
                this.notifys = response.data;
            }).catch(function (error) {
                if (error.response) {
                    // The request was made and the server responded with a status code
                    // that falls out of the range of 2xx
                    console.log(error.response.data);
                    console.log(error.response.status);
                    console.log(error.response.headers);
                } else if (error.request) {
                    // The request was made but no response was received
                    // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                    // http.ClientRequest in node.js
                    console.log(error.request);
                } else {
                    // Something happened in setting up the request that triggered an Error
                    console.log('Error', error.message);
                }
                console.log(error.config);
            });
        },
        async leerNotify(id){
            await axios.post('/markasread',{id: id}).then(response => {
                console.log(response.data);
            }).catch(function (error) {
                if (error.response) {
                    // The request was made and the server responded with a status code
                    // that falls out of the range of 2xx
                    console.log(error.response.data);
                    console.log(error.response.status);
                    console.log(error.response.headers);
                } else if (error.request) {
                    // The request was made but no response was received
                    // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                    // http.ClientRequest in node.js
                    console.log(error.request);
                } else {
                    // Something happened in setting up the request that triggered an Error
                    console.log('Error', error.message);
                }
                console.log(error.config);
            });
        }
    },
    mounted() {
        this.notificaiones();
    }
}
</script>
<template>
    <AppLayout title="HOME">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                HOME
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-white border-b border-gray-100">
                    <div class="bg-blue-300 p-3 m-2" v-for="notificacion in notifys" :key="notificacion.id">
                        <b>{{ notificacion.data.name }}</b> empezo a seguirte!!!...
<!--                        <a :href="route('login')" class="p-2 bg-red-400 text-white rounded-lg">Leeido</a>-->
                        <button class="btn btn-danger p-2 bg-red-400 text-white rounded-lg" id="btn-chat" @click="leerNotify(notificacion.id)">
                            Leer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>


