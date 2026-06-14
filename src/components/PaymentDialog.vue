<template>
  <v-dialog :model-value="modelValue" max-width="500" @update:model-value="$emit('update:modelValue', $event)">
    <v-card class="payment-dialog">
      <button class="close" type="button" aria-label="Закрыть" @click="$emit('update:modelValue', false)">&times;</button>

      <v-card-title class="text-center">Регистрационный взнос 500 ₽</v-card-title>
      <v-card-text class="text-center">
        <p>Для покрытия расходов на обед.</p>

        <div class="payment-buttons">
          <a
            v-for="link in paymentLinks"
            :key="link.title"
            :href="link.href"
            :class="['btn', link.className]"
            target="_blank"
            rel="noopener"
            @click="$emit('pay', link.href)"
          >
            {{ link.title }}
          </a>
        </div>

        <div class="help-title">
          При возникновении трудностей с оплатой регистрационного взноса, пожалуйста, свяжитесь с нами по телефону:
          <br>
          <a href="tel:+79617253115"><span class="help-tel">+7 (961) 725-31-15</span></a>
        </div>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script setup>
import { paymentLinks } from '../data/conference'

defineProps({
  modelValue: {
    type: Boolean,
    default: false,
  },
})

defineEmits(['update:modelValue', 'pay'])
</script>
