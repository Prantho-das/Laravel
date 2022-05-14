<template>
    <Head title="Dashboard"/>

    <BreezeAuthenticatedLayout>
        <template #header>
            Dashboard
        </template>

        <div class="grid grid-cols-12 gap-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-b border-gray-200 md:col-span-4 text-center">
                <h3>You're logged in!</h3>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-b border-gray-200 md:col-span-4 text-center">
                <h3>Total User</h3>
                <p>{{ totalUser }}</p>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-b border-gray-200 md:col-span-4 text-center">
                <h3>Total Donor</h3>
                <p>{{ totalDonor }}</p>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import {Head} from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
    props: {
        totalUser: {
            type: Number,
            default: 0,
        },
        totalDonor: {
            type: Number,
            default: 0,
        },
    },
}
</script>
