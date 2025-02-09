<template>
  <DashboardLayout title="Create Team">
    <template #desc>Create team here</template>

    <Card>
      <form class="[&>div]:mb-3" @submit.prevent="submit">
        <div>
          <Label>Name</Label>
          <Input v-model="form.name" placeholder="Team name" />
          <InputError v-if="form.errors.name">{{ form.errors.name }}</InputError>
        </div>
        <div>
          <Label>Organization</Label>
          <Select v-model="form.organization_id">
            <SelectTrigger>
              <SelectValue placeholder="Select organization" />
            </SelectTrigger>
            <SelectContent>
              <SelectGroup v-for="organization in organizations" :key="organization.id">
                <SelectItem :value="organization.id">{{ organization.name }}</SelectItem>
              </SelectGroup>
            </SelectContent>
          </Select>
          <InputError v-if="form.errors.organization_id">{{ form.errors.organization_id }}</InputError>
        </div>
        <div>
          <Button type="submit" :disabled="form.processing">Create Team</Button>
        </div>
      </form>
    </Card>
  </DashboardLayout>
</template>

<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import Card from "@/components/Card.vue";
import { Label } from "@/components/ui/label/index.js";
import { Input } from "@/components/ui/input/index.js";
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectTrigger,
  SelectValue
} from "@/components/ui/select/index.js";
import { useForm } from "@inertiajs/inertia-vue3";
import { toast } from "vue-sonner";
import { Button } from "@/components/ui/button/index.js";
import InputError from "@/components/InputError.vue";

defineProps({
  organizations: Object
})

const form = useForm({
  name: '',
  organization_id: null
})

const submit = () => {
  form.post(route('dashboard.teams.store'), {
    onSuccess: () => toast.success('Team created successfully')
  });
}
</script>