<template>
    <Toaster richColors position="top-right" closeButton />
    <div class="flex h-screen bg-neutral-50 dark:bg-neutral-900">
        <aside
            :class="{
        'w-64 bg-[#fafaf2] dark:bg-neutral-900 shadow-md transition-transform duration-300 ease-in-out': true,
        '-translate-x-full md:translate-x-0': !isSidebarOpen,
      }"
            class="fixed flex flex-col justify-between inset-y-0 left-0 z-50 overflow-y-auto"
        >
            <div>
                <div class="flex items-center justify-between p-4">
                    <h2 class="text-2xl px-4 text-center font-semibold text-neutral-800 dark:text-neutral-100">Virtus.gg</h2>
                    <button @click="toggleSidebar" class="md:hidden focus:outline-none">
                        <Cross2Icon class="h-4 w-4 text-neutral-800 dark:text-neutral-100" />
                    </button>
                </div>

                <nav class="p-4">
                  <SidebarLink :href="route('dashboard.index')" label="Dashboard" :isActive="route().current('dashboard.index')">
                      <template #icon>
                          <DashboardIcon />
                      </template>
                  </SidebarLink>
                  <SidebarLink :href="route('dashboard.organizations.index')" label="Organizations" :isActive="route().current('dashboard.organizations.*')">
                      <template #icon>
                          <MixerVerticalIcon />
                      </template>
                  </SidebarLink>
                  <SidebarLink :href="route('dashboard.teams.index')" label="Teams" :isActive="route().current('dashboard.teams.*')">
                      <template #icon>
                          <GlobeIcon />
                      </template>
                  </SidebarLink>
                </nav>
            </div>

            <div class="border-t border-neutral-400 flex items-center p-4 gap-4">
                <div class="flex items-center">
                    <DropdownMenu>
                        <DropdownMenuTrigger>
                            <img src="https://api.dicebear.com/9.x/notionists/svg?seed=George" class="w-10 rounded-full bg-neutral-200/60 dark:bg-neutral-600" :alt="user.username" />
                        </DropdownMenuTrigger>
                        <DropdownMenuContent>
                            <DropdownMenuLabel>Welcome, {{ user.email }}</DropdownMenuLabel>
                            <DropdownMenuSeparator />
                            <DropdownMenuItem>
                                <Link :href="route('index')">Homepage</Link>
                            </DropdownMenuItem>
                            <DropdownMenuItem>
                                <form @submit.prevent="logout">
                                    <button class="text-red-500 hover:text-red-600" type="submit">Logout</button>
                                </form>
                            </DropdownMenuItem>
                        </DropdownMenuContent>
                    </DropdownMenu>
                </div>
                <div>
                    <p class="text-lg text-neutral-900 dark:text-neutral-100 font-medium"> {{ user.name }} </p>
                    <p class="text-sm text-neutral-500 dark:text-neutral-300"> {{ user.email }} </p>
                </div>
            </div>
        </aside>

        <div
            v-if="isSidebarOpen"
            @click="toggleSidebar"
            class="fixed inset-0 z-40 bg-black opacity-50 md:hidden transition-opacity duration-300 ease-in-out"
        ></div>

        <main
            class="flex-1 overflow-x-hidden overflow-y-auto md:ml-64 transition-padding duration-300 ease-in-out"
            :class="{ 'ml-0': !isSidebarOpen && !isDesktop }"
        >
            <div class="text-neutral-800 dark:text-neutral-100">
                <header class="flex justify-between items-center p-6 bg-neutral-100 dark:bg-neutral-950 shadow-sm border-b border-neutral-200 dark:border-neutral-600">
                    <button @click="toggleSidebar" class="md:hidden">
                        <HamburgerMenuIcon class="h-4 w-4 text-neutral-800 dark:text-neutral-100" />
                    </button>
                    <h1 class="text-2xl font-semibold text-neutral-800 dark:text-neutral-100">
                        {{ title }}
                    </h1>
                </header>
                <div class="p-6">
                    <p class="mb-2 text-neutral-600 leading-loose">
                        <slot name="desc" />
                    </p>
                    <slot />
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import { ref, onMounted, onUnmounted } from 'vue';
import SidebarLink from '@/components/SidebarLink.vue';
import DropdownSidebarLink from "@/components/DropdownSidebarLink.vue";
import { Cross2Icon, DashboardIcon, HamburgerMenuIcon, HomeIcon, ReaderIcon, SunIcon, MoonIcon, BackpackIcon, MixerVerticalIcon, GlobeIcon } from '@radix-icons/vue';
import DropdownSidebar from "@/components/DropdownSidebar.vue";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuGroup,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuPortal,
    DropdownMenuSeparator,
    DropdownMenuShortcut,
    DropdownMenuSub,
    DropdownMenuSubContent,
    DropdownMenuSubTrigger,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu"
import { Button } from "@/components/ui/button"
import { Link, useForm } from '@inertiajs/inertia-vue3'
import { Toaster } from "@/components/ui/sonner"
import { toast } from "vue-sonner"
import { useAuth } from "@/composables/useAuth.js";

export default {
    components: {
      DropdownSidebar,
      DropdownSidebarLink,
      Link,
      Toaster,
      GlobeIcon,
      MixerVerticalIcon,
      HamburgerMenuIcon,
      BackpackIcon,
      Cross2Icon,
      DashboardIcon,
      ReaderIcon,
      HomeIcon,
      SunIcon,
      MoonIcon,
      Button,
      DropdownMenu,
      DropdownMenuContent,
      DropdownMenuGroup,
      DropdownMenuItem,
      DropdownMenuLabel,
      DropdownMenuPortal,
      DropdownMenuSeparator,
      DropdownMenuShortcut,
      DropdownMenuSub,
      DropdownMenuSubContent,
      DropdownMenuSubTrigger,
      DropdownMenuTrigger,
      SidebarLink
    },

    props: {
        title: {
            type: String,
        },
        auth: Array,
    },

    setup() {
      const isSidebarOpen = ref(false);
      const isDesktop = ref(window.innerWidth >= 768);
      const { user, isAuthenticated } = useAuth()
      const toggleSidebar = () => {
          isSidebarOpen.value = !isSidebarOpen.value;
      };

      const logoutForm = useForm({})
      const logout = () => {
          logoutForm.post(route('logout'), {
              onSuccess: () => toast.success("Logout successfully")
          })
      }

      const handleResize = () => {
          isDesktop.value = window.innerWidth >= 768;
          if (isDesktop.value) isSidebarOpen.value = false;
      };

      onMounted(() => {
          window.addEventListener('resize', handleResize);
      });

      onUnmounted(() => {
          window.removeEventListener('resize', handleResize);
      });

        return {
          user,
          isAuthenticated,
          isSidebarOpen,
          toggleSidebar,
          isDesktop,
          logout
        };
    },
};
</script>
