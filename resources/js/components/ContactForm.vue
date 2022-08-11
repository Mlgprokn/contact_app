<template>
    <div class="mt-5 md:mt-0 md:col-span-2">
        <form>
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-6">
                            <label
                                for="name"
                                class="block text-sm font-medium text-gray-700"
                                >Name</label
                            >
                            <input
                                v-model="contact.name"
                                type="text"
                                name="name"
                                id="name"
                                autocomplete="name"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            />
                            <p
                                v-if="errors.name"
                                class="mt-2 text-sm text-red-500"
                            >
                                {{ errors.name[0] }}
                            </p>
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label
                                for="email"
                                class="block text-sm font-medium text-gray-700"
                                >Email address</label
                            >
                            <input
                                v-model="contact.email"
                                type="text"
                                name="email"
                                id="email"
                                autocomplete="email"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            />
                            <p
                                v-if="errors.email"
                                class="mt-2 text-sm text-red-500"
                            >
                                {{ errors.email[0] }}
                            </p>
                        </div>
                        <div class="col-span-6">
                            <label
                                for="phone"
                                class="block text-sm font-medium text-gray-700"
                                >Phone</label
                            >
                            <input
                                v-model="contact.phone"
                                type="text"
                                name="phone"
                                id="phone"
                                autocomplete="phone"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            />
                            <p
                                v-if="errors.phone"
                                class="mt-2 text-sm text-red-500"
                            >
                                {{ errors.phone[0] }}
                            </p>
                        </div>
                        <div class="col-span-6">
                            <label
                                for="message"
                                class="block text-sm font-medium text-gray-700"
                                >Message</label
                            >
                            <div class="mt-1">
                                <textarea
                                    v-model="contact.message"
                                    id="message"
                                    name="message"
                                    rows="3"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                                />
                            </div>
                            <p
                                v-if="errors.message"
                                class="mt-2 text-sm text-red-500"
                            >
                                {{ errors.message[0] }}
                            </p>
                        </div>
                        <div v-if="success" class="col-span-6">
                            <p class="mt-2 text-sm text-green-500">
                                {{ success }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 text-left sm:px-6">
                    <button
                        type="button"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        @click="sendMessage()"
                    >
                        Send message
                    </button>
                </div>
            </div>
        </form>
    </div>

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
import axios from "axios";

export default {
    name: "ConcactForm",
    data() {
        return {
            contact: {
                name: "",
                email: "",
                phone: "",
                message: "",
            },
            inquiries: [],
            errors: [],
            success: "",
        };
    },
    methods: {
        sendMessage() {
            //reset the values
            this.errors = [];
            this.success = "";

            //make an ajax call to send the message
            axios
                .post("http://localhost:8000/api/inquiries", this.contact)
                .then((response) => {
                    this.success = response.data.success;
                    this.inquiries.push(response.data.inquiry);
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    console.log(error);
                });
        },

        deleteInquiry(id) {
            //make a delete request
            axios
                .delete(`http://localhost:8000/api/inquiries/${id}`)
                .then((response) => {
                    this.inquiries = this.inquiries.filter(
                        (inquiry) => inquiry._id !== response.data.inquiry._id
                    );
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mounted() {
        //get all inqueries
        axios
            .get("http://localhost:8000/api/inquiries")
            .then((response) => {
                this.inquiries = response.data;
            })
            .catch((error) => {
                console.log(error);
            });
    },
};
</script>
