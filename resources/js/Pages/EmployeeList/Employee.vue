<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import Swal from "sweetalert2";
import { router } from '@inertiajs/vue3'
defineProps({
  employees: Array //array data 
});

// sweet alert for the confirmation promt to delete employee 
const confirmDelete = (id) => {
  Swal.fire({
    title: "Are you sure to delete Employee?",
    text: "All the Service Records will be deleted!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Yes!"
  }).then((result) => {
    if (result.isConfirmed) {
      router.delete(`/delete_employees/${id}`, {
        onSuccess: () => {
          Swal.fire("Deleted!", "The employee has been deleted.", "success");
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
                    Employee
                </h2>
                <Link :href="route('employee_form')" class="text-blue-500 hover:text-blue-700">
                    Add Employee
                </Link>
            </div>
        </template>



        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         <tr v-if="employees.length === 0">
                                <td colspan="4" class="text-center font-semibold text-xl text-gray-800 leading-tight"><strong>No data</strong></td>
                        </tr>
                        <!-- looping the data for table -->
                            <tr v-for="employee in employees" :key="employee.id">
                                <td>{{ employee.employee_name }}</td>
                                <td>{{ employee.department?.department_name || '' }}</td>
                                <td>{{ employee.age }}</td>
                                <td>{{ employee.gender }}</td>
                                <td>   <Link :href="route('edit_employee', { id: employee.id })" class="text-blue-500 mx-2 hover:text-blue-700"><i class="bi bi-pencil-square"></i></Link>
                                
                                <button @click="confirmDelete(employee.id)" class="text-red-500 hover:underline"><i class="bi bi-trash3-fill"></i></button>
                                </td>
                                
                            </tr>
                           
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </AppLayout>
</template>
