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
                            <p class="mt-2 text-sm text-gray-500">
                                Message to your contact
                            </p>
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
                        @click="sendMessage(message)"
                    >
                        Send message
                    </button>
                </div>
            </div>
        </form>
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
                .post("http://localhost:8000/api/inquiry", this.contact)
                .then((response) => {
                    this.success = response.data.success;
                    console.log(response);
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    console.log(error);
                });
        },
    },
};
</script>
