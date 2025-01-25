<template>
  <DashboardLayout title="Create Organization">
    <template #desc>Create a new organization</template>

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
          <Button type="submit" :disabled="form.processing">Create organization</Button>
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

const form = useForm({
  name: '',
  description: '',
})

const submit = () => {
  form.post(route('dashboard.organizations.store'), {
      onSuccess: () => toast.success("Organization created successfully")
  })
}
</script>
