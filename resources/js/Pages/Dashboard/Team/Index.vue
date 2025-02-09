<template>
  <DashboardLayout title="Team">
    <template #desc>Manage team here</template>

    <Card class="my-6">
      <ButtonCreate>
        <Link :href="route('dashboard.teams.create')">Create new Team</Link>
      </ButtonCreate>
      <Table>
        <TableHeader>
          <TableRow>
            <TableHead>No</TableHead>
            <TableHead>Name</TableHead>
            <TableHead>Actions</TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          <TableRow v-for="(team, index) in teams" :key="team.id">
            <TableCell>{{ index + 1 }}</TableCell>
            <TableCell>{{ team.name }}</TableCell>
            <TableCell>Virtus Team</TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </Card>
  </DashboardLayout>
</template>

<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import Card from "@/components/Card.vue";
import ButtonCreate from "@/components/ButtonCreate.vue";
import { Link } from '@inertiajs/inertia-vue3';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "@/components/ui/table/index.js";

defineProps({
  teams: Object
})
</script>