<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import Swal from "sweetalert2";
import { router } from '@inertiajs/vue3'
defineProps({
  departments: Array //array data 
});

// sweet alert for the confirmation promt to delete department 
const confirmDelete = (id) => {
  Swal.fire({
    title: "Are you sure you want to delete Department?",
    text: "All the Service Records will be deleted!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Yes!"
  }).then((result) => {
    if (result.isConfirmed) {
      router.delete(`/delete_departments/${id}`, {
        onSuccess: () => {
          Swal.fire("Deleted!", "The department has been deleted.", "success");
        }
      });
    }
  });
};
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Department
                </h2>
                <Link :href="route('department_form')" class="text-blue-500 hover:text-blue-700">
                    Add Department
                </Link>
            </div>
        </template>



        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Department Name</th>
                                 <th>Action</th>
                     
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="departments.length === 0">
                                <td colspan="4" class="mt-4 text-center font-semibold text-xl text-gray-800 leading-tight"><strong>No data</strong></td>
                            </tr>
                               <!-- loopong the data for table -->
                            <tr v-for="(department, index)  in departments" :key="department.id">
                               <td>{{ index + 1 }}</td> 
                                <td>{{ department.department_name }}</td>
                                <td><Link :href="route('edit_department', { id: department.id })" class="text-blue-500 mx-2 hover:text-blue-700"> <i class="bi bi-pencil-square"></i></Link>
                                  <button @click="confirmDelete(department.id)" class="text-red-500 hover:underline"><i class="bi bi-trash3-fill"></i></button>
                                
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
