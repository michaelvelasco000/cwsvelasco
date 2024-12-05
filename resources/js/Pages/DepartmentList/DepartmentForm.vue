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
  department: {
    type: Object,
    default: () => ({})
  }
})

const form = reactive({
  id: props.department.id || '',
  department_name: props.department.department_name || '',

})


const validationErrors = reactive({
  department_name: null,
});


function submit() {
  router.post('/addupdatedepartment', form, {
    onError: (errors) => {
      // Update the reactive validationErrors object
      validationErrors.department_name = errors.department_name || null;
    }
  })
}
</script>

<template>
   <AppLayout title="Dashboard">
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Add Department
                </h2>
       
            </div>
        </template>
        <div class="container">
            <div class="row bg-white justify-content-center">
                <div class="col-md-12">
                <FormSection @submit.prevent="submit">
                  <template #form>
                  <div class="flex flex-column align-self-center">
                    <TextInput id="id" v-model="form.id" hidden/>

                    <div>
                      <!-- Employee Name -->
                      <InputLabel for="department_name">Department Name:</InputLabel>
                      <TextInput id="department_name" v-model="form.department_name" />
                      <InputError :message="validationErrors.department_name" class="text-red-500" />
                    </div>

  
              
                    <!-- Submit Button -->
                    <div class="mt-4">
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