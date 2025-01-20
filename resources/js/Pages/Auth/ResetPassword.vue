<template>
    <AuthLayout>
        <template #title>
            Reset password
        </template>
        <template #subtitle>
            Input your new password
        </template>
        <form class="[&>div]:my-3" @submit.prevent="submit">
            <div>
                <Input type="hidden" />
            </div>
            <div>
                <Label>Email</Label>
                <Input v-model="form.email" type="email" placeholder="team@virtus.gg" />
                <InputError v-if="form.errors.email">{{ form.errors.email }}</InputError>
            </div>
            <div>
                <Label>Password</Label>
                <Input v-model="form.password" type="password" placeholder="*******" />
                <InputError v-if="form.errors.password">{{ form.errors.password }}</InputError>
            </div>
            <div>
                <Label>Password Confirmation</Label>
                <Input v-model="form.password_confirmation" type="password" placeholder="*******" />
                <InputError v-if="form.errors.password_confirmation">{{ form.errors.password_confirmation }}</InputError>
            </div>
            <div>
                <Button type="submit">Reset password</Button>
            </div>
        </form>
    </AuthLayout>
</template>

<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { Input } from "@/components/ui/input/index.js";
import { Label } from "@/components/ui/label/index.js";
import { useForm } from "@inertiajs/inertia-vue3";
import { toast } from "vue-sonner";
import { Button } from "@/components/ui/button/index.js";
import InputError from "@/components/InputError.vue";

 const props = defineProps({
    token: String,
    status: String
})

const form = useForm({
    token: props.token,
    email: null,
    password: null,
    password_confirmation: null
})

const submit = () => {
     form.post(route('password.update'), {
         onSuccess: () => toast.success("Password reset successfully")
     })
}
</script>
