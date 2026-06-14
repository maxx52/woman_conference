<template>
  <section id="top" class="hero-section">
    <v-container class="hero-section__container">
      <div class="hero-section__content">
        <h1 class="hero-section__title title-letters">
          <span class="title-page">{{ conferenceInfo.title }}</span>
          <span class="live">{{ conferenceInfo.subtitle }}</span>
        </h1>
        <a class="boxed-btn-white shadow mt-3" href="#registration">Зарегистрироваться</a>
      </div>
    </v-container>
    <div class="countdown-area">
      <v-container>
        <v-row align="center">
          <v-col cols="12" md="5"><div class="single-date shadow">{{ conferenceInfo.address }}</div></v-col>
          <v-col cols="12" md="4"><div class="single-date shadow">{{ conferenceInfo.date }}</div></v-col>
          <v-col cols="12" md="3"><CountdownTimer :target-date="conferenceInfo.targetDate" /></v-col>
        </v-row>
      </v-container>
    </div>
  </section>
</template>

<script setup>
import { conferenceInfo } from '../data/conference'
import CountdownTimer from './CountdownTimer.vue'
</script>
