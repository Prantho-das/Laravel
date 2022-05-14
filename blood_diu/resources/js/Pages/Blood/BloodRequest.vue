<template>
    <Head title="About us"/>

    <BreezeAuthenticatedLayout>
        <template #header>
            Blood Request
        </template>

        <div class="inline-block overflow-hidden min-w-full rounded-lg shadow">
            <div class="flex flex-wrap md:justify-between gap-2 bg-blue-100 p-3">
                <div class="flex-1 flex-shrink-0">
                    <h2 class="text-xl font-semibold ml-2">
                        Add Blood Request
                    </h2>
                    <form class="transition-all duration-500 overflow-hidden" @submit.prevent="requestBlood"
                          :class="formShow ? 'h-0':''">
                        <div class="m-2">
                            <select class="w-full rounded-md" v-model="want_blood">
                                <option selected value="" disabled>Select Blood Group</option>
                                <option>A+</option>
                                <option>A-</option>
                                <option>B+</option>
                                <option>B-</option>
                                <option>AB+</option>
                                <option>AB-</option>
                                <option>O+</option>
                                <option>O-</option>
                            </select>
                        </div>
                        <span class="text-red-600" v-if="errors.want_blood">{{ errors.want_blood }}</span>
                        <div class="m-2">
                            <input type="text" class="w-full rounded-md" v-model="reason"
                                   placeholder="Please Tell The Reason">
                        </div>
                        <span class="text-red-600" v-if="errors.reason">{{ errors.reason }}</span>
                        <div class="m-2">
                            <input type="datetime-local" v-model="blood_needed_date" class="w-full rounded-md">
                        </div>
                        <span class="text-red-600" v-if="errors.blood_needed_date">{{ errors.blood_needed_date }}</span>
                        <div class="m-2">
                            <textarea v-model="location" class="w-full rounded-md"
                                      placeholder="Please Tell The Correct Location"/>
                        </div>
                        <span class="text-red-600" v-if="errors.location">{{ errors.location }}</span>
                        <div class="m-2">
                            <textarea v-model="description" class="w-full rounded-md"
                                      placeholder="Please Tell The Description"/>
                        </div>
                        <button type="submit" class="px-3 py-2 ml-2 rounded shadow-sm bg-indigo-500 text-white">Make
                            Request
                        </button>
                    </form>
                    <button @click="formShow=!formShow"
                            class="p-2 rounded-md shadow-md bg-green-400 block ml-auto -mt-6 mr-3">
                        <transition
                            enter-to-class="transition-all duration-300 ease-in-out"
                            enter-from-class="max-h-0 opacity-25"
                            leave-from-class="opacity-100 max-h-xl"
                            leave-to-class="max-h-0 opacity-0">
                        <span class="transition-all duration-300"
                              :class="formShow?'rotate-180':''">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                </svg>
                        </span>
                        </transition>
                    </button>
                </div>
                <div class="flex-1 flex-shrink-0">
                    <h2 class="text-xl font-semibold">
                        Blood Request Made By Me
                    </h2>
                    <table class="w-full whitespace-no-wrap" v-if='myrequest.data.length > 0'>
                        <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                            <th class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                B-Group
                            </th>
                            <th class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                Date
                            </th>
                            <th class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                Found
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="request in myrequest.data" :key="myrequest.id" class="text-gray-700">
                            <th class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                {{ request.want_blood }}
                            </th>
                            <th class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                {{ request.blood_needed_date }}
                            </th>
                            <th class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                {{ request.status }}
                            </th>
                        </tr>
                        </tbody>
                    </table>
                    <div v-if="myrequest.data.length > 0"
                         class="flex flex-col items-center px-5 py-5 bg-white border-t xs:flex-row xs:justify-between">
                        <pagination :links="myrequest.links"/>
                    </div>
                </div>
            </div>
            <div class="inline-flex overflow-hidden w-full bg-white rounded-lg shadow-md">
                <div class="flex justify-center items-center w-12 bg-blue-500">
                    <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"></path>
                    </svg>
                </div>

                <div class="px-4 py-2 -mx-3">
                    <div class="mx-3">
                        <span class="font-semibold text-blue-500">Info</span>
                        <p class="text-sm text-gray-600">People Needed Blood</p>
                    </div>
                </div>
            </div>

            <table class="w-full whitespace-no-wrap" v-if='brequests.data.length > 0'>
                <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                    <th class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Name
                    </th>
                    <th class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        phone
                    </th>
                    <th class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Blood Group
                    </th>
                    <th class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Location
                    </th>
                    <th class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Reason
                    </th>
                    <th class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Needed Date
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="request in brequests.data" :key="brequests.id" class="text-gray-700">
                    <th class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        {{ request.rel_user.name }}
                    </th>
                    <th class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        {{ request.rel_user.phone }}
                    </th>
                    <th class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        {{ request.want_blood }}
                    </th>
                    <th class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        {{ request.location }}
                    </th>
                    <th class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        {{ request.reason }}
                    </th>
                    <th class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        {{ request.blood_needed_date }}
                    </th>

                </tr>
                </tbody>
            </table>
            <h2 class="m-2" v-else>No Previous Result Found</h2>

            <div v-if="brequests.data.length > 0"
                 class="flex flex-col items-center px-5 py-5 bg-white border-t xs:flex-row xs:justify-between">
                <pagination :links="brequests.links"/>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Pagination.vue';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Pagination,
    },

    props: {
        brequests: Object,
        errors: Object,
        myrequest: Object
    },
    data() {
        return {
            want_blood: '',
            location: '',
            reason: '',
            blood_needed_date: '',
            description: '',
            formShow: false,
        };
    },
    methods: {
        requestBlood() {
            this.$inertia.post(this.route('donate.requestPost'),
                {
                    want_blood: this.want_blood,
                    location: this.location,
                    reason: this.reason,
                    blood_needed_date: this.blood_needed_date,
                    description: this.description
                }).then((res) => {
                console.log(res)
            }).catch(error => {
                console.log(error);
            });
        }
    }
}
</script>
