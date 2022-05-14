<template>
<header class="flex justify-between items-center px-6 py-4 bg-white border-b-4 border-indigo-600">
    <div class="flex items-center">
        <button @click="$page.props.showingMobileMenu = !$page.props.showingMobileMenu" class="text-gray-500 focus:outline-none lg:hidden">
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round"/>
            </svg>
        </button>
    </div>

    <div class="flex items-center">
        <dropdown>
            <template #trigger>
                <button @click="dropdownOpen = ! dropdownOpen" class="block overflow-hidden relative">
                    {{ $page.props.auth.user.name }}
                </button>
            </template>

            <template #content>
                <dropdown-link :href="route('profile.show')">
                    My profile
                </dropdown-link>

                <dropdown-link class="w-full text-left" :href="route('logout')" method="post" as="button">
                    Log out
                </dropdown-link>
            </template>
        </dropdown>
        <div class="relative" @click="notification">
            <svg  xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 ml-2 z-50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span class="absolute -top-2 right-0 px-0.5 rounded bg-indigo-500 text-white !z-20">{{notifications.length}}</span>
        </div>

    </div>
</header>
</template>

<script>
import Dropdown from '@/Components/Dropdown';
import DropdownLink from '@/Components/DropdownLink';
import axios from "axios"
export default {
    components: {
        Dropdown,
        DropdownLink,
    },
    data(){
        return{
            notifications:[]
        }
    },
    mounted() {
        this.notification()
        console.log(document.title)
        if(this.notifications.length > 0){
            console.log(this.notifications)
           let title=document.title
           document.title=`(${this.notifications.length})${title}`
        }
    },
    methods:{
        notification(){
            axios.get(this.route('notification'))
                .then(response => {
                   this.notifications = response.data
                })
                .catch(error => {
                    console.log(error);
                });
            if(this.notifications.length > 0){
                this.notificationRead();
            }
        },
        notificationRead(){
            axios.post(this.route('notification.read'))
                .then(response => {
                   if(response.data){
                       this.notifications=response.data
                   }
                })
                .catch(error => {
                    console.log(error);
                });
        },
    }
}
</script>
