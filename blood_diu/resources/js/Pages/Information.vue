<template>
    <Head title="Information" />

    <BreezeAuthenticatedLayout>
        <template #header> Information Page </template>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <BreezeValidationErrors class="mb-4" />

                <form @submit.prevent="form.put('information')">
                    <div class="mt-3">
                        <BreezeLabel for="phone" value="Phone No" />
                        <BreezeInput
                            id="phone"
                            type="tel"
                            class="block mt-1 w-full"
                            v-model="form.phone"
                            required
                        />
                    </div>
                    <div v-if="form.errors.phone">{{ form.errors.phone }}</div>
                    <div class="mt-3">
                        <BreezeLabel for="address" value="Address" />
                        <textarea
                            id="address"
                            class="block rounded-md mt-1 w-full"
                            v-model="form.address"
                            required
                        />
                    </div>

                    <div class="mt-3">
                        <BreezeLabel for="blood" value="Blood Group" />
                        <select
                            id="blood"
                            type="tel"
                            class="block rounded-md mt-1 w-full"
                            v-model="form.blood_group"
                        >
                            <option value="" selected>
                                Please Select Your Blood Group
                            </option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <BreezeLabel
                            for="vaccinated"
                            value="Are Your Covid Vaccinated?"
                        />
                        <div class="flex items-center">
                            <label for="v_yes" class="mr-2">Yes</label>
                            <input
                                id="v_yes"
                                type="radio"
                                v-model="form.vaccine"
                                value="1"
                                name="vaccine_status"
                            />
                        </div>
                        <div class="flex items-center">
                            <label for="v_no" class="mr-2">No</label>
                            <input
                                id="v_no"
                                type="radio"
                                value="0"
                                v-model="form.vaccine"
                                name="vaccine_status"
                            />
                        </div>
                    </div>

                    <div class="flex justify-end mt-4">
                        <BreezeButton
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Submit
                        </BreezeButton>
                    </div>
                </form>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import BreezeButton from "@/Components/Button";
import BreezeInput from "@/Components/Input";
import BreezeLabel from "@/Components/Label";
import BreezeValidationErrors from "@/Components/ValidationErrors";

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
    },
    data() {
        return {
            form: this.$inertia.form({
                phone: null,
                blood_group: "",
                address: null,
                vaccine: null,
            }),
        };
    }
};
</script>
