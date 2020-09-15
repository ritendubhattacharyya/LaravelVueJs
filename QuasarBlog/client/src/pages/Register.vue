<template>
  <q-page class="flex flex-center column">
    <div>
      <q-banner inline-actions class="text-white bg-red-7">
        Register
      </q-banner>
      <RegisterComponent></RegisterComponent>
    </div>
  </q-page>
</template>

<script>
import RegisterComponent from '../components/RegisterComponent'


export default {
  name: 'Register',
  components: {
    RegisterComponent,
  }
}
</script>