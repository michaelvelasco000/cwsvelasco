<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
defineProps({
  servicerecords: Array //array data 
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
                        
                            <tr v-for="(servicerecord,index) in servicerecords" :key="servicerecord.id">
                                  <td>{{ index + 1 }}</td> 
                                <td>{{ servicerecord.employee_name }}</td>
                                <td>{{ servicerecord.department_name }}</td>
                                <td>{{ servicerecord.start_date }}</td>
                                  <td>{{ servicerecord.end_date }}</td>
                                <td v-if="!servicerecord.end_date"><Link :href="route('endservice', { id: servicerecord.id })"  class="text-blue-500 hover:text-blue-700"> End Service</Link></td>
                                <td v-else></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
