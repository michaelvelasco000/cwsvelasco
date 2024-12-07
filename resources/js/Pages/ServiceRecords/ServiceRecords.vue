<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
defineProps({
  service_records: Array //array data 
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Service Record
                </h2>
                
            </div>
        </template>



        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee Name</th>
                                <th>Department Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- looping the data for table -->
                            <tr v-for="(service_record,index) in service_records" :key="service_record.id">
                                  <td>{{ index + 1 }}</td> 
                                <td>{{ service_record.employee.employee_name }}</td>
                                <td>{{ service_record.department.department_name }}</td>
                                <td>{{ service_record.start_date }}</td>
                                  <td>{{ service_record.end_date }}</td>
                                <td v-if="!service_record.end_date"><Link :href="route('end_service', { id: service_record.id })"  class="text-blue-500 hover:text-blue-700"> End Service</Link></td>
                                <td v-else></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
