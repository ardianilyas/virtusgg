<template>
    <DashboardLayout title="Organization">

        <template #desc>Manage your organization here.</template>

        <Card class="my-6">
            <div class="flex gap-2">
              <ButtonCreate>
                <Link :href="route('dashboard.organizations.create')">Create new organization</Link>
              </ButtonCreate>
            </div>
            <div class="mb-3 max-w-xs">
              <form @submit.prevent="submitJoin">
                <Label>Code</Label>
                <div class="flex items-center gap-2">
                  <Input v-model="joinForm.code" placeholder="VIRTUS" />
                  <Button type="submit">Join</Button>
                </div>
                <InputError v-if="joinForm.errors.code">{{ joinForm.errors.code }}</InputError>
              </form>
            </div>
            <Table>
              <TableCaption>*Note : code is used by member to join your organization</TableCaption>
                <TableHeader>
                    <TableRow>
                        <TableHead>No</TableHead>
                        <TableHead>Name</TableHead>
                        <TableHead>Code</TableHead>
                        <TableHead>Description</TableHead>
                        <TableHead>Total Members</TableHead>
                        <TableHead>Status</TableHead>
                        <TableHead>Created at</TableHead>
                        <TableHead>Actions</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="(organization, index) in organizations.data" :key="organization.id">
                        <TableCell>{{ displayNumber(organizations, index) }}</TableCell>
                        <TableCell>{{ organization.name }}</TableCell>
                        <TableCell>{{ organization.code }}</TableCell>
                        <TableCell>{{ organization.description }}</TableCell>
                        <TableCell>{{ organization.members_count }}</TableCell>
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
                                      <Link :href="route('dashboard.organizations.show', organization.id)">
                                        View
                                      </Link>
                                    </DropdownMenuItem>
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
                                              <Button class="inline-flex w-full" type="submit" variant="destructive">Yes, delete it</Button>
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
          <Pagination :links="organizations" />
        </Card>
    </DashboardLayout>
</template>

<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { displayNumber } from "@/helpers/helpers.js";
import { Button } from "@/components/ui/button/index.js";
import { Link, useForm } from "@inertiajs/inertia-vue3";
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
import Pagination from "@/components/Pagination.vue";
import { Label } from "@/components/ui/label/index.js";
import { Input } from "@/components/ui/input/index.js";
import InputError from "@/components/InputError.vue";
import { onMounted } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";

const { props } = usePage()

// onMounted(() => {
//   if(props.flash?)
// })

const deleteForm = useForm({})

const joinForm = useForm({
  code: ''
})

const submitJoin = () => {
  joinForm.post(route('dashboard.organizations.join'), {
    onSuccess: () => toast.success("Success join organization"),
    onError: (err) => toast.error(err.code ?? err[1])
  })
}

const submitDelete = (id) => {
  deleteForm.delete(route('dashboard.organizations.destroy', id), {
    onSuccess: () => toast.success("Organization deleted successfully")
  })
}

defineProps({
    organizations: Object
})
</script>
