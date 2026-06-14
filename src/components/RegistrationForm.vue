<template>
  <section id="registration" class="registration-section">
    <v-container>
      <v-row justify="center">
        <v-col cols="12" sm="8" md="6" lg="5">
          <h3 class="mb-8 text-center">Форма регистрации</h3>

          <v-form class="submit-form" @submit.prevent="openPayment">
            <input v-model.trim="form.name" type="text" name="name" placeholder="Имя" class="single-input">
            <input v-model.trim="form.lastName" type="text" name="lastName" placeholder="Фамилия" class="single-input">
            <input v-model="form.birthday" type="text" name="birthday" placeholder="дд.мм.гггг" class="single-input" @input="maskBirthday">
            <input v-model.trim="form.city" type="text" name="city" placeholder="Город" class="single-input">
            <input v-model.trim="form.church" type="text" name="church" placeholder="Церковь" class="single-input">
            <input v-model.trim="form.ministry" type="text" name="ministry" placeholder="Служение в церкви" class="single-input">
            <input v-model.trim="form.email" type="email" name="email" placeholder="Ваша электронная почта" class="single-input" @input="removeCyrillicFromEmail">
            <input v-model="form.phone" type="text" name="phone" placeholder="+7 (___) ___-__-__" class="single-input" @input="maskPhone">

            <div class="mt-4 mb-8 d-flex justify-center">
              <button class="genric-btn primary" type="submit">Зарегистрироваться</button>
            </div>
          </v-form>

          <div class="personal-data-text">
            Заполнением и отправкой этой формы я подтверждаю
            согласие на сбор, хранение и
            использование моих персональных данных в соответствии с федеральным законом от 27.07.2006 № 152–ФЗ
            «О персональных данных»
          </div>
        </v-col>
      </v-row>
    </v-container>

    <PaymentDialog v-model="paymentDialog" @pay="sendForm" />
  </section>
</template>

<script setup>
import { reactive, ref } from 'vue'
import PaymentDialog from './PaymentDialog.vue'

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

const requiredFields = {
  name: 'Имя',
  lastName: 'Фамилия',
  birthday: 'Дата рождения',
  city: 'Город',
  church: 'Церковь',
  ministry: 'Служение в церкви',
  email: 'Ваша электронная почта',
  phone: 'Телефон',
}

function validateForm() {
  for (const [key, title] of Object.entries(requiredFields)) {
    if (!form[key].trim()) {
      alert(`Поле "${title}" обязательно для заполнения.`)
      return false
    }
  }

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
  if (!emailRegex.test(form.email)) {
    alert('Некорректный формат email.')
    return false
  }

  const phoneRegex = /^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/
  if (!phoneRegex.test(form.phone)) {
    alert('Введите номер в формате: +7 (XXX) XXX-XX-XX')
    return false
  }

  return true
}

function openPayment() {
  if (validateForm()) {
    paymentDialog.value = true
  }
}

function maskBirthday() {
  const digits = form.birthday.replace(/\D/g, '').slice(0, 8)
  const parts = [digits.slice(0, 2), digits.slice(2, 4), digits.slice(4, 8)].filter(Boolean)
  form.birthday = parts.join('.')
}

function maskPhone() {
  const digits = form.phone.replace(/\D/g, '').replace(/^7/, '').slice(0, 10)
  const p1 = digits.slice(0, 3)
  const p2 = digits.slice(3, 6)
  const p3 = digits.slice(6, 8)
  const p4 = digits.slice(8, 10)

  let value = '+7'
  if (p1) value += ` (${p1}`
  if (p1.length === 3) value += ')'
  if (p2) value += ` ${p2}`
  if (p3) value += `-${p3}`
  if (p4) value += `-${p4}`

  form.phone = value
}

function removeCyrillicFromEmail() {
  if (/[а-яА-ЯёЁ]/.test(form.email)) {
    form.email = form.email.replace(/[а-яА-ЯёЁ]/g, '')
    alert('В email разрешены только латинские буквы, цифры и символы: . _ % + -')
  }
}

async function sendForm(paymentUrl) {
  const formData = new FormData()

  Object.entries(form).forEach(([key, value]) => {
    formData.append(key, value)
  })

  formData.append('project_name', 'Сайт женской конференции')
  formData.append('admin_email', 'admin@krepost-krasota.ru')
  formData.append('form_subject', 'Регистрация нового участника')

  try {
    const response = await fetch('/mail.php', {
      method: 'POST',
      body: formData,
    })

    if (!response.ok) {
      alert('Ошибка отправки данных. Попробуйте ещё раз.')
      return
    }

    window.location.href = paymentUrl
  } catch (error) {
    console.error(error)
    alert('Произошла ошибка при отправке данных.')
  }
}
</script>
