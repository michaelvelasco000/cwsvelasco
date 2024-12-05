<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
defineProps({
  servicerecords: Array //array data 
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
             
                        <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Employee Name</th>
                                <th>Department Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                        
                            <tr v-for="servicerecord in servicerecords" :key="servicerecord.id">
                                <td>{{ servicerecord.employee_name }}</td>
                                <td>{{ servicerecord.department_name }}</td>
                                <td>{{ servicerecord.start_date }}</td>
                                  <td>{{ servicerecord.end_date }}</td>
                               
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
