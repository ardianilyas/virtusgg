<template>
  <DashboardLayout title="Edit Organization">
    <template #desc>Edit your organization information</template>

    <BackLink :href="route('dashboard.organizations.index')">
      Back to previous
    </BackLink>

    <Card>
      <form class="[&>div]:mb-3" @submit.prevent="submit">
        <div>
          <Label>Name</Label>
          <Input v-model="form.name" type="text" placeholder="Virtus.inc" />
          <InputError v-if="form.errors.name">{{ form.errors.name }}</InputError>
        </div>
        <div>
          <Label>Description</Label>
          <Input v-model="form.description" type="text" placeholder="A short description" />
          <InputError v-if="form.errors.description">{{ form.errors.description }}</InputError>
        </div>
        <div>
          <Button type="submit" :disabled="form.processing">Edit organization</Button>
        </div>
      </form>
    </Card>
  </DashboardLayout>
</template>

<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import Card from "@/components/Card.vue";
import { Link, useForm } from '@inertiajs/inertia-vue3'
import { Label } from "@/components/ui/label/index.js";
import { Input } from "@/components/ui/input/index.js";
import { Button } from "@/components/ui/button/index.js";
import { toast } from "vue-sonner";
import InputError from "@/components/InputError.vue";
import BackLink from "@/components/BackLink.vue";

const props = defineProps({
  organization: Object
})

const form = useForm({
  name: props.organization.name,
  description: props.organization.description,
})

const submit = () => {
  form.patch(route('dashboard.organizations.update', props.organization.id), {
    onSuccess: () => toast.success("Organization updated successfully")
  })
}
</script>
