<template>
  <footer class="site-footer site-shadow">
    <div class="site-container">
      <div class="footer-row">
        <div class="footer-col">
          <h3 class="footer-title">Подпишись</h3>
          <ul class="footer-links">
            <li v-for="link in socialLinks" :key="link.href">
              <a :href="link.href" target="_blank" rel="noopener">{{ link.label }}</a>
            </li>
          </ul>
        </div>

        <div class="footer-col">
          <h3 class="footer-title">Организатор</h3>
          <p class="organizer">
            Церковь «Новый Завет»<br>
            г. Барнаул, пр-т Космонавтов, д. 12/7
          </p>
        </div>
      </div>

      <div class="footer-copy">
        <p class="mb-0">
          2026 © Религиозная группа Церковь христиан веры евангельской пятидесятников «Новый Завет» г. Барнаул уч.н. 2218010079<br>
          <a target="_blank" href="/" rel="noopener">Реквизиты организации</a>
          |
          <a target="_blank" href="/" rel="noopener">Политика конфиденциальности</a>
        </p>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { socialLinks } from '@/data/conference'
</script>
