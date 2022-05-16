<template>
    <Head title="About us" />

    <BreezeAuthenticatedLayout>
        <template #header> Total Donate </template>
        <div class="inline-block overflow-hidden min-w-full rounded-lg shadow">
            <div
                class="inline-flex overflow-hidden w-full bg-white rounded-lg shadow-md"
            >
                <div class="flex justify-center items-center w-12 bg-blue-500">
                    <svg
                        class="w-6 h-6 text-white fill-current"
                        viewBox="0 0 40 40"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"
                        ></path>
                    </svg>
                </div>

                <div class="px-4 py-2 -mx-3">
                    <div class="mx-3">
                        <span class="font-semibold text-blue-500">Info</span>
                        <p class="text-sm text-gray-600">Your Donation Time</p>
                    </div>
                </div>
                <h4 class="text-2xl ml-auto mr-2 text-capitalize italic">
                    You Are A
                    <span class="text-green-500" v-if="status">Donor</span>
                    <span class="text-red-500" v-else>Not A Donor</span>
                </h4>
            </div>
            <div class="p-2 bg-green-500 rounded">
                <div class="text-white" v-if="status">
                    <h2 class="text-lg">I Don't Want to Donate?</h2>
                    <button class="px-3 py-2 rounded bg-red-500" @click="deny">
                        I Agree
                    </button>
                </div>
                <div class="text-white" v-else>
                    <h2 class="text-lg">Do You Want To Donate?</h2>
                    <label class="text-capitalize">last donate</label>
                    <input
                        class="block"
                        type="checkbox"
                        v-model="last_donate"
                    />
                    <div v-if="last_donate">
                        <label class="text-capitalize mt-2"
                            >last donate Date</label
                        >
                        <input
                            class="block rounded w-full text-black h-10"
                            type="date"
                            v-model="last_donate_date"
                            placeholder="Last Donate Date"
                        />
                         <input
                            class="block rounded w-full text-black h-10 my-2"
                            type="text"
                            v-model="address"
                            placeholder="Last Donate Reason"
                        />
                         <input
                            class="block rounded w-full text-black h-10"
                            type="text"
                            v-model="reason"
                            placeholder="Last Donate Address"
                        />
                    </div>
                    <button class="px-3 py-2 rounded bg-indigo-500 mt-2" @click="donate">
                        Want To Donate
                    </button>
                </div>
            </div>
            <table
                class="w-full whitespace-no-wrap"
                v-if="histories.data.length > 0"
            >
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b"
                    >
                        <th
                            class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200"
                        >
                            Donation Address
                        </th>
                        <th
                            class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200"
                        >
                            Reason Of Donation
                        </th>
                        <th
                            class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200"
                        >
                            Last Donated
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="history in histories.data"
                        :key="history.id"
                        class="text-gray-700"
                    >
                        <td
                            class="px-5 py-5 text-sm bg-white border-b border-gray-200"
                        >
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ history.address }}
                            </p>
                        </td>
                        <td
                            class="px-5 py-5 text-sm bg-white border-b border-gray-200"
                        >
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ history.reason }}
                            </p>
                        </td>
                        <td
                            class="px-5 py-5 text-sm bg-white border-b border-gray-200"
                        >
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ history.last_donate }}
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <h2 class="m-2" v-else>No Previous Result Found</h2>

            <div
                v-if="histories.data.length > 0"
                class="flex flex-col items-center px-5 py-5 bg-white border-t xs:flex-row xs:justify-between"
            >
                <pagination :links="histories.links" />
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Pagination from "@/Components/Pagination.vue";

export default {
    components: {
        BreezeAuthenticatedLayout,
        Pagination,
    },

    props: {
        histories: Object,
    },
    data() {
        return {
            last_donate: false,
            last_donate_date: null,
            address:null,
            reason:null
        };
    },
    methods: {
        donate() {
            this.$inertia.post(
                this.route('users.blood_status'),
                {
                    wantToDonate: true,
                    lastDonate: this.last_donate,
                    lastDonateDate: this.last_donate_date,
                    address:this.address,
                    reason:this.reason
                },
                {
                    onSuccess: (data) => {

                    },
                    onError:(error)=>{

                    }
                }
            );
        },
        deny() {
            this.$inertia.post(
                this.route('users.blood_status'),
                {
                    wantToDonate: false,
                },
                {
                    onSuccess: (data) => {

                    },
                    onError:(error)=>{

                    }
                }
            );
        },
    },
    computed: {
        status() {
            let auth = this.$page.props.auth;
            return auth ? auth.user.blood_status : auth.user.blood_status;
        },
    },
};
</script>
