<template>
  <section class="hero-section">
    <div class="site-container">
      <div class="title-text">
        <h1 class="site-shadow">
          <span class="title-page">{{ conferenceInfo.title }}</span>
          <br>
          <br>
          <span class="live">{{ conferenceInfo.subtitle }}</span>
        </h1>
        <a href="#registration" class="boxed-btn-white site-shadow mt-3">
          Зарегистрироваться
        </a>
      </div>
    </div>

    <div class="countdown-strip">
      <div class="site-container countdown-row">
        <div class="single-date site-shadow">{{ conferenceInfo.address }}</div>
        <div class="single-date site-shadow">{{ conferenceInfo.date }}</div>
        <div class="countdown-timer site-shadow" aria-label="Обратный отсчет до конференции">
          <div v-for="item in timerItems" :key="item.label" class="timer-item">
            <span class="timer-value">{{ item.value }}</span>
            <span class="timer-label">{{ item.label }}</span>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { computed, onBeforeUnmount, onMounted, ref } from 'vue'
import { conferenceInfo } from '@/data/conference'

const remaining = ref(getRemainingTime())
let intervalId

const timerItems = computed(() => [
  { label: 'Дней', value: formatTime(remaining.value.days) },
  { label: 'Часов', value: formatTime(remaining.value.hours) },
  { label: 'Мин', value: formatTime(remaining.value.minutes) },
  { label: 'Сек', value: formatTime(remaining.value.seconds) },
])

function getRemainingTime() {
  const distance = new Date(conferenceInfo.targetDate).getTime() - Date.now()

  if (distance <= 0) {
    return { days: 0, hours: 0, minutes: 0, seconds: 0 }
  }

  return {
    days: Math.floor(distance / (1000 * 60 * 60 * 24)),
    hours: Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
    minutes: Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)),
    seconds: Math.floor((distance % (1000 * 60)) / 1000),
  }
}

function formatTime(value) {
  return value.toString().padStart(2, '0')
}

onMounted(() => {
  intervalId = window.setInterval(() => {
    remaining.value = getRemainingTime()
  }, 1000)
})

onBeforeUnmount(() => {
  window.clearInterval(intervalId)
})
</script>
