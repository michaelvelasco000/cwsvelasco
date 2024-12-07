<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
defineProps({
  service_records: Array //array data 
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
                        
                            <tr v-for="service_record in service_records" :key="service_record.id">
                                <td>{{ service_record.employee.employee_name }}</td>
                                <td>{{ service_record.department.department_name }}</td>
                                <td>{{ service_record.start_date }}</td>
                                  <td>{{ service_record.end_date }}</td>
                               
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
