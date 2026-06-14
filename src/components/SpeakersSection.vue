<template>
  <div class="speakers-section">
    <div class="site-container">
      <div class="content-column">
        <h2 class="text-center text-prim speaker-title">Спикеры конференции</h2>

        <article v-for="speaker in speakers" :key="speaker.name" class="speaker">
          <img :src="speaker.image" :alt="speaker.alt" class="speaker-img">
          <p class="speaker-name text-prim">{{ speaker.name }}</p>
          <p class="speaker-description">{{ speaker.description }}</p>
        </article>
      </div>
    </div>
  </div>
</template>

<script setup>
import { speakers } from '@/data/conference'
</script>
