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

      <div class="my-5 max-w-sm px-4">
        <h4 class="mb-3 text-xl font-medium text-neutral-800">Members</h4>
        <div class="border-b py-3" v-for="member in members.members" :key="member.id">
          <h5 class="font-medium text-neutral-800">{{ member.name }}</h5>
          <p class="capitalize text-sm text-neutral-500">{{ member.pivot.role }}</p>
        </div>
      </div>
    </Card>
  </DashboardLayout>
</template>

<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import Card from "@/components/Card.vue";
import BackLink from "@/components/BackLink.vue";

defineProps({
  organization: Object,
  members: Object
})
</script>