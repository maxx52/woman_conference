<template>
  <v-app>
    <AppHeader />

    <v-main>
      <HeroSection />
      <SpeakersSection />
      <ConditionsSection />
      <RegistrationForm />
    </v-main>

    <AppFooter />
  </v-app>
</template>

<script setup>
import AppHeader from './components/AppHeader.vue'
import HeroSection from './components/HeroSection.vue'
import SpeakersSection from './components/SpeakersSection.vue'
import ConditionsSection from './components/ConditionsSection.vue'
import RegistrationForm from './components/RegistrationForm.vue'
import AppFooter from './components/AppFooter.vue'
</script>
