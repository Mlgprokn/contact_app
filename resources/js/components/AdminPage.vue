<template>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                All Inquiries
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Information about name and message
            </p>
        </div>
        <div class="border-t border-gray-200">
            <div
                class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                v-for="inquiry in inquiries"
                v-bind:key="inquiry._id"
            >
                <div class="text-sm font-medium text-gray-500">
                    <button
                        class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded"
                        @click="deleteInquiry(inquiry._id)"
                    >
                        X
                    </button>
                    {{ inquiry.name }}
                </div>
                <div class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <p class="truncate">
                        {{ inquiry.message }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AdminPage",
    props: {
        inquiries: Object,
    },
    methods: {
        deleteInquiry(id) {
            //emit the event to the parent
            this.$emit("deleteInquiry", id);
        },
    },
};
</script>
