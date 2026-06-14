<template>
  <div class="countdown-timer shadow">
    <div class="timer-item">
      <span class="days">{{ timeLeft.days }}</span>
      <span class="label">Дней</span>
    </div>
    <div class="timer-item">
      <span class="hours">{{ timeLeft.hours }}</span>
      <span class="label">Часов</span>
    </div>
    <div class="timer-item">
      <span class="minutes">{{ timeLeft.minutes }}</span>
      <span class="label">Мин</span>
    </div>
    <div class="timer-item">
      <span class="seconds">{{ timeLeft.seconds }}</span>
      <span class="label">Сек</span>
    </div>
  </div>
</template>

<script setup>
import { computed, onBeforeUnmount, onMounted, ref } from 'vue'

const props = defineProps({
  targetDate: {
    type: String,
    required: true,
  },
})

const now = ref(Date.now())
let timerId = null

const pad = value => String(Math.max(0, value)).padStart(2, '0')

const timeLeft = computed(() => {
  const target = new Date(props.targetDate).getTime()
  const distance = Math.max(0, target - now.value)

  const days = Math.floor(distance / (1000 * 60 * 60 * 24))
  const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))
  const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))
  const seconds = Math.floor((distance % (1000 * 60)) / 1000)

  return {
    days: pad(days),
    hours: pad(hours),
    minutes: pad(minutes),
    seconds: pad(seconds),
  }
})

onMounted(() => {
  timerId = window.setInterval(() => {
    now.value = Date.now()
  }, 1000)
})

onBeforeUnmount(() => {
  window.clearInterval(timerId)
})
</script>
