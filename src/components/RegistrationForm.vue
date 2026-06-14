<template>
  <div id="registration" class="registration-section">
    <div class="site-container">
      <div class="content-column">
        <h3 class="registration-title">Форма регистрации</h3>

        <form class="submit-form" @submit.prevent="openPayment">
          <input type="hidden" name="project_name" value="Сайт женской конференции">
          <input type="hidden" name="admin_email" value="admin@krepost-krasota.ru">
          <input type="hidden" name="form_subject" value="Регистрация нового участника">

          <input v-model="form.name" type="text" name="name" placeholder="Имя" class="single-input">
          <input v-model="form.lastName" type="text" name="lastName" placeholder="Фамилия" class="single-input">
          <input
            v-model="form.birthday"
            type="text"
            name="birthday"
            placeholder="дд.мм.гггг"
            maxlength="10"
            class="single-input"
            @input="maskBirthday"
          >
          <input v-model="form.city" type="text" name="city" placeholder="Город" class="single-input">
          <input v-model="form.church" type="text" name="church" placeholder="Церковь" class="single-input">
          <input v-model="form.ministry" type="text" name="ministry" placeholder="Служение в церкви" class="single-input">
          <input
            v-model="form.email"
            type="email"
            name="email"
            placeholder="Ваша электронная почта"
            class="single-input"
            @input="removeCyrillicFromEmail"
          >
          <input
            v-model="form.phone"
            type="text"
            name="phone"
            placeholder="+7 (___) ___-__-__"
            maxlength="18"
            class="single-input"
            @input="maskPhone"
          >

          <div class="form-action">
            <button type="submit" class="genric-btn primary">Зарегистрироваться</button>
          </div>
        </form>
      </div>

      <div class="consent">
        Заполнением и отправкой этой формы я подтверждаю
        согласие на сбор, хранение и
        использование моих персональных данных в соответствии с федеральным законом от 27.07.2006 № 152-ФЗ
        «О персональных данных»
      </div>
    </div>

    <div v-if="paymentDialog" class="payment-modal" @click.self="paymentDialog = false">
      <div class="payment-modal-content" role="dialog" aria-modal="true">
        <button type="button" class="modal-close" aria-label="Закрыть" @click="paymentDialog = false">&times;</button>

        <h3>Регистрационный взнос 500&nbsp;₽</h3>
        <p>Для покрытия расходов на обед.</p>

        <div class="payment-buttons">
          <a
            v-for="button in paymentButtons"
            :key="button.label"
            :href="button.href"
            :class="['payment-link', button.className]"
            target="_blank"
            rel="noopener"
            @click.prevent="submitAndPay(button.href)"
          >
            {{ button.label }}
          </a>
        </div>

        <div class="help-title">
          При возникновении трудностей с оплатой регистрационного взноса, пожалуйста, свяжитесь с нами по телефону:
          <br>
          <a href="tel:+79617253115"><span class="help-tel">+7 (961) 725-31-15</span></a>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref } from 'vue'
import { paymentLinks } from '@/data/conference'

const paymentDialog = ref(false)

const form = reactive({
  name: '',
  lastName: '',
  birthday: '',
  city: '',
  church: '',
  ministry: '',
  email: '',
  phone: '',
})

const paymentButtons = [
  { label: 'Оплата СБЕР', href: paymentLinks.sber, className: 'sber' },
  { label: 'Оплата Т-Банк', href: paymentLinks.tbank, className: 'tbank' },
  { label: 'Оплата ВТБ', href: paymentLinks.vtb, className: 'vtb' },
]

function openPayment() {
  if (!validateForm()) return
  paymentDialog.value = true
}

async function submitAndPay(paymentUrl) {
  if (!validateForm()) return

  try {
    await fetch('/mail.php', {
      method: 'POST',
      body: toFormData(),
    })
  } catch (error) {
    console.error('Ошибка:', error)
  } finally {
    window.location.href = paymentUrl
  }
}

function validateForm() {
  const requiredFields = ['name', 'lastName', 'birthday', 'city', 'church', 'ministry', 'email', 'phone']
  const emptyField = requiredFields.find((field) => !String(form[field] || '').trim())

  if (emptyField) {
    alert('Заполните обязательные поля формы.')
    return false
  }

  if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(form.email)) {
    alert('Некорректный формат email. Пример: user@domain.com')
    return false
  }

  if (!/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/.test(form.phone)) {
    alert('Введите номер в формате: +7 (XXX) XXX-XX-XX')
    return false
  }

  return true
}

function toFormData() {
  const formData = new FormData()

  formData.append('project_name', 'Сайт женской конференции')
  formData.append('admin_email', 'admin@krepost-krasota.ru')
  formData.append('form_subject', 'Регистрация нового участника')

  Object.entries(form).forEach(([key, value]) => {
    formData.append(key, value)
  })

  return formData
}

function maskBirthday() {
  const digits = form.birthday.replace(/\D/g, '').slice(0, 8)
  const parts = [digits.slice(0, 2), digits.slice(2, 4), digits.slice(4, 8)].filter(Boolean)
  form.birthday = parts.join('.')
}

function maskPhone() {
  const digits = form.phone.replace(/\D/g, '').replace(/^7/, '').slice(0, 10)
  const first = digits.slice(0, 3)
  const second = digits.slice(3, 6)
  const third = digits.slice(6, 8)
  const fourth = digits.slice(8, 10)

  let value = '+7'
  if (first) value += ` (${first}`
  if (first.length === 3) value += ')'
  if (second) value += ` ${second}`
  if (third) value += `-${third}`
  if (fourth) value += `-${fourth}`

  form.phone = value
}

function removeCyrillicFromEmail() {
  form.email = form.email.replace(/[а-яА-ЯёЁ]/g, '')
}
</script>
