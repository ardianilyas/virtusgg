<template>
    <AuthLayout>
        <template #title>
            Forgot password
        </template>
        <template #subtitle>
            Please input your email to reset password
        </template>
        <div v-if="status">
            <p>{{ status }}</p>
        </div>
        <form class="my-3 [&>div]:my-3" @submit.prevent="submit">
            <div>
                <Label>Email</Label>
                <Input v-model="form.email" type="email" placeholder="team@virtus.gg" />
                <InputError v-if="form.errors.email">{{ form.errors.email }}</InputError>
            </div>
            <div>
                <Button :disabled="form.processing" type="submit">Send Reset Password Link</Button>
            </div>
        </form>
    </AuthLayout>
</template>

<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { Label } from "@/components/ui/label/index.js";
import { Input } from "@/components/ui/input/index.js";
import { Button } from "@/components/ui/button/index.js";
import { useForm } from "@inertiajs/inertia-vue3";
import InputError from "@/components/InputError.vue";
import { toast } from "vue-sonner";

defineProps({
    status: String
})

const form = useForm({
    email: 'ardian@virtus.gg'
});

const submit = () => {
    form.post(route('password.email'), {
        onSuccess: () => toast.success("Email reset password sent")
    })
}

</script>
