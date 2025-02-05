<template>
  <DashboardLayout title="Request List">
    <template #desc>Request list for <b>{{ organization.name }}</b> </template>

    <Card class="my-6">
      <Table>
        <TableCaption></TableCaption>
        <TableHeader>
          <TableRow>
            <TableHead>No</TableHead>
            <TableHead>Name</TableHead>
            <TableHead>Email</TableHead>
            <TableHead>Status</TableHead>
            <TableHead>Actions</TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          <TableRow v-for="(user, index) in requesting_users.data" :key="user.id">
            <TableCell>{{ displayNumber(requesting_users, index) }}</TableCell>
            <TableCell>{{ user.name }}</TableCell>
            <TableCell>{{ user.email }}</TableCell>
            <TableCell class="text-xs">
              <StatusBadge :status="user.pivot.status">{{ user.pivot.status }}</StatusBadge>
            </TableCell>
            <TableCell>
              <DropdownMenu>
                <DropdownMenuTrigger>
                  <Button variant="ghost" size="icon">
                    <DotsHorizontalIcon />
                  </Button>
                </DropdownMenuTrigger>
                <DropdownMenuContent>
                  <DropdownMenuLabel>Change status</DropdownMenuLabel>
                  <DropdownMenuSeparator />
                  <DropdownMenuItem v-for="status in statuses">
                    <Link @click="toast.success('Request status updated')" :href="route('dashboard.organization.changeStatus', [user.pivot.id, status])">{{ status }}</Link>
                  </DropdownMenuItem>
                </DropdownMenuContent>
              </DropdownMenu>
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>
      <Pagination :links="requesting_users" />
    </Card>
  </DashboardLayout>
</template>

<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { Link, useForm } from '@inertiajs/inertia-vue3'
import Card from "@/components/Card.vue";
import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableHead,
  TableHeader,
  TableRow
} from "@/components/ui/table/index.js";
import { DotsHorizontalIcon } from "@radix-icons/vue";
import StatusBadge from "@/components/StatusBadge.vue";
import { displayNumber } from "@/helpers/helpers.js";
import Pagination from "@/components/Pagination.vue";
import {
  DropdownMenu,
  DropdownMenuContent, DropdownMenuItem,
  DropdownMenuLabel, DropdownMenuSeparator,
  DropdownMenuTrigger
} from "@/components/ui/dropdown-menu/index.js";
import { Button } from "@/components/ui/button/index.js";
import { toast } from "vue-sonner";

defineProps({
  organization: Object,
  requesting_users: Object
});

const statuses = [
    'accepted', 'rejected'
]

const form = useForm({
  status: ''
})

const changeStatus = (status) => {
  form.status = status
  console.log(status)
}
</script>