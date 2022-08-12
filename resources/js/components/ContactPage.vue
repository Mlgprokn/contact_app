<template>
    <contact-form
        @sendMessage="sendMessage"
        :errors="errors"
        :success="success"
    />
    <admin-page @deleteInquiry="deleteInquiry" :inquiries="inquiries" />
</template>

<script>
import ContactForm from "./ContactForm.vue";
import AdminPage from "./AdminPage.vue";
import axios from "axios";

export default {
    components: { ContactForm, AdminPage },
    name: "ContactPage",
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
        sendMessage(contact) {
            //clear the labels
            this.errors = [];
            this.success = "0";

            //make an ajax call to send the message
            axios
                .post("http://localhost:8000/api/inquiries", contact)
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
