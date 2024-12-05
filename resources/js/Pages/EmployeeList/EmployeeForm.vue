<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
  employee: {
    type: Object,
    default: () => ({})
  },
   departments: {
    type: Object,
    default: () => ({})
  }
})

const form = reactive({
  id: props.employee.id || '',
  employee_name: props.employee.employee_name || '',
  age: props.employee.age || '',
  gender: props.employee.gender || '',
  department_id: props.employee.department_id || ''
})
const option = reactive({
  department_id: props.departments.id || '',
  department_name: props.departments.department_name || ''
})

const validationErrors = reactive({
  employee_name: null,
  age: null,
  gender: null,
  department_id: null
});

function submit() {
  router.post('/updateemployee', form, {
    onError: (errors) => {
      // Update the reactive validationErrors object
      validationErrors.employee_name = errors.employee_name || null;
      validationErrors.age = errors.age || null;
      validationErrors.gender = errors.gender || null;
      validationErrors.department_id = errors.department_id || null;
    }
  })
}
</script>

<template>
   <AppLayout title="Dashboard">
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Add Employee
                </h2>
             
            </div>
        </template>
      
        <div class="container">
            <div class="row bg-white justify-content-center">
                <div class="col-md-12">
                <FormSection @submit.prevent="submit">
                  <template #form >
                    
                    <div class="flex flex-column align-self-center">
                    <TextInput id="id" v-model="form.id" hidden/>

                    <div>
                      <!-- Employee Name -->
                      <InputLabel for="employee_name">First name:</InputLabel>
                      <TextInput id="employee_name" v-model="form.employee_name" />
                      <InputError :message="validationErrors.employee_name" class="text-red-500" />
                    </div>

  
                    <div>
                      <!-- Age -->
                      <InputLabel for="age">Age:</InputLabel>
                      <TextInput id="age" v-model="form.age" />
                      <InputError :message="validationErrors.age" class="text-red-500" />
                    </div>

                    <div>
                      <!-- Gender -->
                      <InputLabel for="gender">Gender:</InputLabel>
                      <TextInput id="gender" v-model="form.gender" />
                      <InputError :message="validationErrors.gender" class="text-red-500" />
                    </div>

                <div>
              <InputLabel for="department_id">Gender:</InputLabel>
                <select v-model="form.department_id" id="department_id">
                    <option 
                        v-for="department in departments" 
                        :key="department.id" 
                        :value="department.id"  >
                        {{ department.department_name }}
                    </option>
                </select>


            
                <InputError :message="validationErrors.department_id" class="text-red-500" />
            </div>

                    <!-- Submit Button -->

                    <div class="mt-5">
                      <PrimaryButton type="submit">Submit</PrimaryButton>
                    </div>
                    </div>
                  </template>
                </FormSection>
                </div>
                </div>
                </div>
 </AppLayout>
</template>