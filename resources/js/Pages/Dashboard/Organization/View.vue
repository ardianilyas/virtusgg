<template>
  <DashboardLayout title="Organization Details">
    <template #desc>Lorem ipsum dolor sit amet, consectetur.</template>
    <BackLink :href="route('dashboard.organizations.index')">Back to organizations</BackLink>
    <Card>
      <div class="flex items-center p-2 gap-6">
        <div>
          <img v-if="organization.image_path" :src="organization.image_path" width="50" />
        </div>
        <div>
          <h2 class="text-3xl text-neutral-800 font-medium">{{ organization.name }}</h2>
          <p class="text-neutral-600 leading-relaxed">{{ organization.description }}</p>
        </div>
      </div>

      <div class="my-5 max-w-md px-4">
        <h4 class="mb-3 text-xl font-medium text-neutral-800">Members</h4>
        <div v-for="member in members.members" :key="member.id">
          <div class="border-b py-3 flex flex-col sm:flex-row sm:justify-between sm:items-center" v-if="user.id !== member.pivot.user_id">
            <div class="mb-3 sm:mb-0">
              <h5 class="font-medium text-neutral-800 line-clamp-2">{{ member.name }}</h5>
              <p class="capitalize text-sm text-neutral-500">{{ member.pivot.role }}</p>
            </div>
            <div v-if="user.id === organization.creator_id">
              <Button variant="secondary" size="sm" as-child>
                <Link :href="route('dashboard.organizations.assignRoleProjectManager', [organization.id, member.pivot.user_id])">Assign Project Manager</Link>
              </Button>
            </div>
          </div>
        </div>
      </div>
    </Card>
  </DashboardLayout>
</template>

<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import Card from "@/components/Card.vue";
import BackLink from "@/components/BackLink.vue";
import { Link } from '@inertiajs/inertia-vue3';
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuTrigger
} from "@/components/ui/dropdown-menu/index.js";
import { Button } from "@/components/ui/button/index.js";
import { useAuth } from "@/composables/useAuth.js";
import { toast } from "vue-sonner";

defineProps({
  organization: Object,
  members: Object
})

const { user } = useAuth()
</script>