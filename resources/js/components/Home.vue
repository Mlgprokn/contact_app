<template>
    <div class="mt-5 md:mt-0 md:col-span-2">
        <form action="#" method="POST">
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-6">
                            <label
                                for="first-name"
                                class="block text-sm font-medium text-gray-700"
                                >Name</label
                            >
                            <input
                                type="text"
                                name="first-name"
                                id="first-name"
                                autocomplete="given-name"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            />
                        </div>

                        <div class="col-span-6 sm:col-span-6">
                            <label
                                for="email-address"
                                class="block text-sm font-medium text-gray-700"
                                >Email address</label
                            >
                            <input
                                type="text"
                                name="email-address"
                                id="email-address"
                                autocomplete="email"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            />
                        </div>

                        <div class="col-span-6">
                            <label
                                for="street-address"
                                class="block text-sm font-medium text-gray-700"
                                >Number</label
                            >
                            <input
                                type="text"
                                name="street-address"
                                id="street-address"
                                autocomplete="street-address"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            />
                        </div>

                        <div class="col-span-6">
                            <label
                                for="street-address"
                                class="block text-sm font-medium text-gray-700"
                                >Message</label
                            >
                            <div class="mt-1">
                                <textarea
                                    id="about"
                                    name="about"
                                    rows="3"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                                />
                            </div>
                            <p class="mt-2 text-sm text-gray-500">
                                Message to your contact
                            </p>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button
                        type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {};
</script>
