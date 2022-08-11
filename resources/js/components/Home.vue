<template>
    <contact-form />
    <inquiries />
</template>

<script>
import ContactForm from "./ContactForm.vue";
import Inquiries from "./Inquiries.vue";

export default {
    components: { ContactForm, Inquiries },
    name: "Home",
};
</script>
