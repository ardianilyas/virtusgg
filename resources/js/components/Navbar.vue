<template>
    <header class="container sticky top-8 mx-auto mt-8">
        <nav class="bg-white w-full backdrop-filter backdrop-blur-lg rounded-full shadow-md bg-opacity-30 py-4 px-6 flex justify-between items-center">
            <Link href="/" class="flex gap-2">
                <img src="logo.svg" width="22" height="22">
                <h2 class="text-xl font-medium">Virtus.gg</h2>
            </Link>
            <ul class="md:flex gap-4 hidden">
                <li>
                    <NavLink :href="route('index')" label="Home" :active="route().current('index')" />
                </li>
                <li>
                    <NavLink href="/" label="About" />
                </li>
                <li>
                    <NavLink href="/" label="Pricing" />
                </li>
                <li v-if="isAuthenticated">
                    <NavLink href="/" label="Dashboard" />
                </li>
                <li v-if="isAuthenticated">
                    <Dialog>
                        <DialogTrigger class="font-light text-neutral-600 hover:text-red-500">Logout</DialogTrigger>
                        <DialogContent>
                            <DialogHeader>
                                <DialogTitle>Are you sure want to logout ?</DialogTitle>
                                <DialogDescription>Lorem ipsum dolor sit amet, consectetur.</DialogDescription>
                            </DialogHeader>
                            <DialogFooter class="sm:justify-start">
                                <DialogClose as-child>
                                    <Button variant="secondary">Cancel</Button>
                                </DialogClose>
                                <form @submit.prevent="logout">
                                    <Button type="submit" variant="destructive">Confirm</Button>
                                </form>
                            </DialogFooter>
                        </DialogContent>
                    </Dialog>
                </li>
            </ul>
            <div class="flex gap-2">
                <button class="block md:hidden" @click="showMenu = !showMenu">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5" />
                    </svg>
                </button>
                <PrimaryLink v-if="!isAuthenticated" :href="route('signin')" label="Sign In" />
                <p v-if="isAuthenticated">Welcome, {{ user.name }}</p>
            </div>
        </nav>
        <div v-show="showMenu" class="md:hidden fixed top-0 left-0 w-full h-screen bg-gray-100 z-50 transition-transform duration-300 ease-in-out" :style="{ transform: showMenu ? 'translateX(0)' : 'translateX(-100%)' }">
            <button class="w-full flex justify-end px-6 pt-4" @click="showMenu = !showMenu">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="p-4 flex flex-col gap-4">
                <ul>
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li>
                        <a href="/">About</a>
                    </li>
                    <li>
                        <a href="/">Pricing</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
</template>

<script>
import NavLink from "./NavLink.vue";
import { Link } from "@inertiajs/inertia-vue3";
import PrimaryLink from "./PrimaryLink.vue";
import { useAuth } from "@/composables/useAuth.js";
import { Inertia } from "@inertiajs/inertia";
import { toast } from "vue-sonner";
import {
    Dialog, DialogClose,
    DialogContent,
    DialogDescription, DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger
} from "@/components/ui/dialog/index.js";
import {Button} from "@/components/ui/button/index.js";

export default {
    components: {
        DialogClose,
        DialogFooter,
        DialogDescription,
        DialogTitle,
        DialogHeader,
        DialogContent,
        Button,
        DialogTrigger,
        Dialog,
        NavLink,
        Link,
        PrimaryLink,
    },
    data() {
        const { user, isAuthenticated } = useAuth()
        return {
            showMenu: false,
            user, isAuthenticated
        };
    },
    methods: {
        logout() {
            Inertia.post('/logout', {}, {
                onSuccess: () => toast.success("Logout successfully")
            })
        }
    }
};
</script>
