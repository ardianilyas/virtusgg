<template>
    <AuthLayout>
        <template #title>
            Verify your email address
        </template>
        <template #subtitle>
            We have sent you email verification, please verify your email first to access dashboard. Didn't receive email verification ?
        </template>
        <form class="mt-3" @submit.prevent="resend">
            <Button :disabled="form.processing" type="submit">Resend email verification</Button>
        </form>
    </AuthLayout>
</template>

<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { Button } from "@/components/ui/button/index.js";
import { useForm } from "@inertiajs/inertia-vue3";
import {toast} from "vue-sonner";

const form = useForm({})
const resend = () => {
    form.post(route('verification.send'), {
        onSuccess: () => toast.success("Email verification send successfully")
    })
}
</script>
