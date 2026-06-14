<template>
  <v-app>
    <AppBar />

    <v-main>
      <HeroSection />
      <section class="speakers-area speakers-content-area">
        <SpeakersSection />
        <ConditionsSection />
        <RegistrationForm />
      </section>
    </v-main>

    <Footer />
  </v-app>
</template>

<script setup>
  import AppBar from './components/AppBar.vue'
  import HeroSection from './components/HeroSection.vue'
  import SpeakersSection from './components/SpeakersSection.vue'
  import ConditionsSection from './components/ConditionsSection.vue'
  import RegistrationForm from './components/RegistrationForm.vue'
  import Footer from './components/Footer.vue'
</script>
