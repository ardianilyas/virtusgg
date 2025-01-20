<template>
    <AuthLayout>
        <template #title>
            Create an account
        </template>
        <template #subtitle>
            Already have an account ? <Link :href="route('signin')" class="text-blue-500 hover:text-blue-600 underline underline-offset-6">signin here</Link>
        </template>
        <form class="mt-4 [&>div]:my-3" @submit.prevent="submit">
            <div>
                <Label>Name</Label>
                <Input v-model="form.name" type="text" placeholder="Virtus Team" />
                <InputError v-if="form.errors.name">{{ form.errors.name }}</InputError>
            </div>
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
                <Button :disabled="form.processing" type="submit">Signup</Button>
            </div>
        </form>
    </AuthLayout>
</template>

<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Label } from "@/components/ui/label/index.js";
import { Input } from "@/components/ui/input/index.js";
import { Button } from "@/components/ui/button/index.js";
import { useForm } from "@inertiajs/inertia-vue3";
import {toast} from "vue-sonner";
import InputError from "@/components/InputError.vue";

const form = useForm({
    name: null,
    email: null,
    password: null
})

const submit = () => {
    form.post(route('signup.store'), {
        onSuccess: () => toast.success("Signup successfully")
    })
}
</script>
