<template>
  <section class="speakers-area">
    <v-container>
      <v-row align="center" justify="center">
        <v-col cols="12" sm="8" md="6" lg="5">
          <h2 class="text-center text-prim text-uppercase speaker-title mb-8">Спикеры конференции</h2>

          <article v-for="speaker in speakers" :key="speaker.name" class="speaker mb-8">
            <div class="img-container">
              <img :src="speaker.image" :alt="speaker.alt" class="speaker-img">
            </div>
            <div class="text-container">
              <p class="speaker-name text-prim text-center">{{ speaker.name }}</p>
              <p class="speaker-description text-dark text-center">{{ speaker.description }}</p>
            </div>
          </article>

          <img src="/assets/img/time-img.jpg" alt="Расписание" class="img-time">
        </v-col>
      </v-row>
    </v-container>
  </section>
</template>

<script setup>
import { speakers } from '../data/conference'
</script>
