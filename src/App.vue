<template>
  <v-app>
    <AppBar />

    <v-main>
      <HeroSection />
      <SpeakersSection />
      <ConditionsSection />
      <RegistrationForm />
    </v-main>

    <Footer />
  </v-app>
</template>

<script setup>
  import HeroSection from './components/HeroSection.vue'
  import SpeakersSection from './components/SpeakersSection.vue'
  import ConditionsSection from './components/ConditionsSection.vue'
  import RegistrationForm from './components/RegistrationForm.vue'
</script>