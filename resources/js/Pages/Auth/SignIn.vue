<template>
    <AuthLayout>
        <template #title>
            Sign In
        </template>
        <template #subtitle>
            Dont have an account ? Signup here {{ user }}
        </template>
        <form class="mt-4 [&>div]:my-3" @submit.prevent="submit">
            <div>
                <Label>Email</Label>
                <Input v-model="form.email" type="email" placeholder="team@virtus.gg" />
                <InputError v-if="form.errors.email">{{ form.errors.email }}</InputError>
            </div>
            <div>
                <Label>Password</Label>
                <Input v-model="form.password" type="password" placeholder="********" />
                <InputError v-if="form.errors.password">{{ form.errors.password }}</InputError>
            </div>
            <div>
                <Button type="submit">Signin</Button>
            </div>
        </form>
    </AuthLayout>
</template>

<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { Input } from "@/components/ui/input/index.js";
import { Label } from "@/components/ui/label/index.js";
import { Button } from "@/components/ui/button/index.js";
import {useForm} from "@inertiajs/inertia-vue3";
import InputError from "@/components/InputError.vue";
import { toast } from "vue-sonner";

const form = useForm({
    email: 'ardian@virtus.gg',
    password: 'developer'
});

const submit = () => {
    form.post(route('signin.authenticate'), {
        onSuccess: () => toast.success("Signin successfully")
    })
}
</script>
