<template>
    <DashboardLayout title="Organization">

        <template #desc>Manage your organization here.</template>


        <Card class="my-6">
            <ButtonCreate class="mb-3">
              <Link :href="route('dashboard.organizations.create')">Create new organization</Link>
            </ButtonCreate>
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>No</TableHead>
                        <TableHead>Name</TableHead>
                        <TableHead>Description</TableHead>
                        <TableHead>Status</TableHead>
                        <TableHead>Created at</TableHead>
                        <TableHead>Actions</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="(organization, index) in organizations" :key="organization.id">
                        <TableCell>{{ index + 1 }}</TableCell>
                        <TableCell>{{ organization.name }}</TableCell>
                        <TableCell>{{ organization.description }}</TableCell>
                        <TableCell class="capitalize" :class="organization.status === 'active' ? 'text-green-400' : 'text-red-500' ">{{ organization.status }}</TableCell>
                        <TableCell>{{ organization.created_at }}</TableCell>
                        <TableCell>
                            <DropdownMenu>
                                <DropdownMenuTrigger>
                                    <Button variant="ghost" size="icon">
                                        <DotsHorizontalIcon />
                                    </Button>
                                </DropdownMenuTrigger>
                                <DropdownMenuContent>
                                    <DropdownMenuLabel>Actions</DropdownMenuLabel>
                                    <DropdownMenuSeparator />
                                    <DropdownMenuItem>
                                      <Link :href="route('dashboard.organizations.edit', organization.id)">Edit</Link>
                                    </DropdownMenuItem>
                                    <DropdownMenuItem>
                                      <Dialog>
                                        <DialogTrigger @click.stop as-child>
                                          <button type="button">Delete</button>
                                        </DialogTrigger>
                                        <DialogContent>
                                          <DialogHeader>
                                            <DialogTitle>Are you sure ?</DialogTitle>
                                            <DialogDescription>Want to delete <b>{{ organization.name }}</b> ? This action cannot be undo </DialogDescription>
                                          </DialogHeader>
                                          <DialogFooter class="sm:justify-start">
                                            <form @click.prevent="submitDelete(organization.id)">
                                              <Button type="submit" variant="destructive">Yes, delete it</Button>
                                            </form>
                                            <DialogClose as-child>
                                              <Button variant="secondary">Cancel</Button>
                                            </DialogClose>
                                          </DialogFooter>
                                        </DialogContent>
                                      </Dialog>
                                    </DropdownMenuItem>
                                </DropdownMenuContent>
                            </DropdownMenu>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </Card>
    </DashboardLayout>
</template>

<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { Button } from "@/components/ui/button/index.js";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import Card from "@/components/Card.vue";
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "@/components/ui/table/index.js";
import {
    DropdownMenu,
    DropdownMenuContent, DropdownMenuItem,
    DropdownMenuLabel, DropdownMenuSeparator,
    DropdownMenuTrigger
} from "@/components/ui/dropdown-menu/index.js";
import { DotsHorizontalIcon, PlusIcon } from "@radix-icons/vue";
import ButtonCreate from "@/components/ButtonCreate.vue";
import { toast } from "vue-sonner";
import {
  Dialog, DialogClose,
  DialogContent, DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
  DialogTrigger
} from "@/components/ui/dialog/index.js";

const deleteForm = useForm({})

const submitDelete = (id) => {
  deleteForm.delete(route('dashboard.organizations.destroy', id), {
    onSuccess: () => toast.success("Organization deleted successfully")
  })
}

defineProps({
    organizations: Object
})
</script>
