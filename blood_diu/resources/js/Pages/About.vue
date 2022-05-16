<template>
    <Head title="About us" />

    <BreezeAuthenticatedLayout>
        <template #header> About Your Blood Donate </template>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <div
                    v-show="$page.props.flash.success"
                    class="inline-flex w-full mb-4 overflow-hidden bg-white rounded-lg shadow-md"
                >
                    <div
                        class="flex items-center justify-center w-12 bg-green-500"
                    >
                        <svg
                            class="w-6 h-6 text-white fill-current"
                            viewBox="0 0 40 40"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z"
                            ></path>
                        </svg>
                    </div>

                    <div class="px-4 py-2 -mx-3">
                        <div class="mx-3">
                            <span class="font-semibold text-green-500"
                                >Success</span
                            >
                            <p class="text-sm text-gray-600">
                                {{ $page.props.flash.success }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center">
                    <form @submit.prevent="upload">
                        <div
                            class="mb-3 w-96 border-2 border-gray-400 p-3 rounded"
                        >
                            <label
                                for="formFileSm"
                                class="form-label inline-block mb-2 text-gray-700"
                                >Please Enter Your Image for Your Gallery

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"
                                />
                            </svg>
                            </label>
                            <input
                                class="form-control hidden w-full px-2 py-1 text-sm font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                id="formFileSm"
                                type="file"
                                @input="
                                    form.gallery_image = $event.target.files[0]
                                "
                            />
                        </div>
                        <div class="w-full">
                            <progress
                                v-if="form.progress"
                                :value="form.progress.percentage"
                                max="100"
                            >
                                {{ form.progress.percentage }}%
                            </progress>
                        </div>
                        <button class="bg-indigo-500 rounded p-2 text-white">
                            Upload
                        </button>
                    </form>
                </div>
            </div>
            <section class="overflow-hidden text-gray-700">
                <div class="px-5 py-2 mx-auto lg:pt-24">
                    <div class="flex flex-wrap">
                        <div class="flex flex-wrap">
                            <div
                                v-for="(gallery, i) in galleries"
                                :key="i"
                                class="p-1 md:p-2"
                                :class="i % 2 > 0 ? 'w-1/2' : 'w-5/12'"
                            >
                                <img
                                    alt="gallery"
                                    class="block object-cover object-center w-full h-full rounded-lg"
                                    :src="'/images/' + gallery.image_link"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
    props: {
        galleries: Array,
    },
    data() {
        return {
            form: this.$inertia.form({
                gallery_image: null,
            }),
        };
    },
    methods: {
        upload() {
            this.form.post(this.route("donate.image"));
        },
    },
};
</script>
